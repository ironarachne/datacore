<?php

namespace App\Http\Controllers;

use App\Pattern;
use App\PatternSlot;
use App\Profession;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PatternController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        $patterns = Pattern::All();

        return view('pattern.index', ['patterns' => $patterns]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        $professions = Profession::All();

        return view('pattern.create', ['professions' => $professions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $pattern = new Pattern;

        $this->save($pattern, $request);

        return redirect()->route('pattern.show', ['pattern' => $pattern]);
    }

    /**
     * Display the specified resource.
     *
     * @param Pattern $pattern
     *
     * @return Renderable
     */
    public function show(Pattern $pattern)
    {
        return view('pattern.show', ['pattern' => $pattern]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Pattern $pattern
     *
     * @return Renderable
     */
    public function edit(Pattern $pattern)
    {
        $professions = Profession::All();

        $tags = convert_tags_to_string($pattern);

        return view('pattern.edit', ['pattern' => $pattern, 'professions' => $professions, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Pattern $pattern
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Pattern $pattern)
    {
        $this->save($pattern, $request);

        return redirect()->route('pattern.show', ['pattern' => $pattern]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Pattern $pattern
     *
     * @return Response
     */
    public function destroy(Pattern $pattern)
    {
        //
    }

    public function save(Pattern $pattern, Request $request)
    {
        $pattern->name = $request->name;
        $pattern->description = $request->description;
        $pattern->name_template = $request->name_template;
        $pattern->main_material_override = $request->main_material_override;
        $pattern->origin_override = $request->origin_override;
        $pattern->commonality = $request->commonality;
        $pattern->value = $request->value;

        $pattern->save();

        $pattern->professions()->sync($request->professions);

        update_tags($pattern, $request->tags);
    }

    // Slot functions

    public function createSlot(Pattern $pattern)
    {
        return view('pattern.slot.create', ['pattern' => $pattern]);
    }

    public function editSlot(Pattern $pattern, PatternSlot $slot)
    {
        return view('pattern.slot.edit', ['pattern' => $pattern, 'slot' => $slot]);
    }

    public function storeSlot(Pattern $pattern, Request $request)
    {
        $slot = new PatternSlot;

        $this->saveSlot($pattern, $slot, $request);

        return redirect()->route('pattern.show', ['pattern' => $pattern]);
    }

    public function updateSlot(Pattern $pattern, PatternSlot $slot, Request $request)
    {
        $this->saveSlot($pattern, $slot, $request);

        return redirect()->route('pattern.show', ['pattern' => $pattern]);
    }

    public function saveSlot(Pattern $pattern, PatternSlot $slot, Request $request)
    {
        $slot->name = $request->name;
        $slot->required_tag = $request->required_tag;
        $slot->description_template = $request->description_template;
        $slot->possible_quirks = $request->possible_quirks;
        $slot->pattern_id = $pattern->id;

        $slot->save();
    }

    public function getJSON()
    {
        $patterns = Pattern::with(['tags', 'slots'])->get()->toJSON();

        $patterns = '{"patterns":' . $patterns . '}';

        return response($patterns)->header('Content-Type', 'application/json');
    }

    public function storeFromJson(Request $request)
    {
        $missingProfessions = [];

        $data = json_decode($request->data);

        if (empty($data->patterns)) {
            return response('invalid data for patterns', '400');
        }

        $newRecordsCount = 0;

        foreach($data->patterns as $object) {
            $pattern = new Pattern;

            $pattern->name = $object->name;
            $pattern->description = $object->description;
            $pattern->commonality = $object->commonality;
            $pattern->name_template = $object->name_template;
            $pattern->main_material_override = $object->main_material_override;
            $pattern->origin_override = $object->origin_override;
            $pattern->value = $object->value;

            $pattern->save();

            $profession = Profession::where('name', '=', $object->profession_name)->first();
            if (!empty($profession)) {
                $pattern->professions()->save($profession);
            } else {
                if (!in_array($object->profession_name, $missingProfessions)) {
                    $missingProfessions[] = $object->profession_name;
                }
            }

            if (!empty($object->slots)) {
                foreach($object->slots as $slot) {
                    $s = new PatternSlot;
                    $s->name = $slot->name;
                    $s->required_tag = $slot->required_tag;
                    $s->description_template = $slot->description_template;
                    $s->possible_quirks = $slot->possible_quirks;

                    $pattern->slots()->save($s);
                }
            }

            if (sizeof($object->tags) > 0) {
                $tags = implode(',', $object->tags);
                update_tags($pattern, $tags);
            }

            $newRecordsCount++;
        }

        return response()->json([
            'state' => 'success',
            'new_records_count' => $newRecordsCount,
            'missing_professions' => $missingProfessions,
        ]);
    }
}
