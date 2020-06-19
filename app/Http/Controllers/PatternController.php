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
}
