<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use App\Models\Tag;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        $charges = Charge::orderBy('identifier')->paginate(15);

        return view('charge.index', ['charges' => $charges]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('charge.create');
    }

    public function json()
    {
        return view('charge.json');
    }

  
    public function search(Request $request)
    {
        $name = $request->input('name');

        $charges = Charge::where('name', 'like', "%$name%")->orderBy('name')->paginate(15);

        return view('charge.search', ['charges' => $charges]);
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
        $charge = new Charge;

        $this->save($charge, $request);

        return redirect()->route('charge.show', ['charge' => $charge]);
    }

    /**
     * Display the specified resource.
     *
     * @param Charge $charge
     *
     * @return Renderable
     */
    public function show(Charge $charge)
    {
        return view('charge.show', ['charge' => $charge]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Charge $charge
     *
     * @return Renderable
     */
    public function edit(Charge $charge)
    {
        $tags = convert_tags_to_string($charge);

        return view('charge.edit', ['charge' => $charge, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Charge $charge
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Charge $charge)
    {
        $this->save($charge, $request);

        return redirect()->route('charge.show', ['charge' => $charge]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Charge $charge
     *
     * @return Response
     */
    public function destroy(Charge $charge)
    {
        //
    }

    function save(Charge $charge, Request $request)
    {
        $charge->name = $request->name;
        $charge->identifier = $request->identifier;
        $charge->noun = $request->noun;
        $charge->noun_plural = $request->noun_plural;
        $charge->single_only = $request->has('single_only');
        $charge->descriptor = $request->descriptor;

        $charge->save();

        update_tags($charge, $request->tags);
    }

    public function getJSON(Request $request)
    {
        if (!empty($request->query('tag'))) {
            $tag = Tag::where('name', '=', $request->query('tag'))->first();
            if (empty($tag)) {
                return response('{"charges": []}')->header('Content-Type', 'application/json');
            }
            $charges = $tag->charges()->with('tags')->get()->toJson();
        } else {
            $charges = Charge::with('tags')->get()->toJson();
        }

        $charges = '{"charges":' . $charges . '}';

        return response($charges)->header('Content-Type', 'application/json');
    }

    public function storeFromJson(Request $request)
    {
        $data = json_decode($request->data);

        if (empty($data->charges)) {
            return response('invalid data for charges', '400');
        }

        $newRecordsCount = 0;

        foreach ($data->charges as $object) {
            $charge = new Charge;

            $charge->name = $object->name;
            $charge->identifier = $object->identifier;
            $charge->noun = $object->noun;
            $charge->noun_plural = $object->noun_plural;
            $charge->descriptor = $object->descriptor;
            $charge->single_only = $object->single_only;

            $charge->save();

            if (sizeof($object->tags) > 0) {
                $tagArray = [];
                foreach ($object->tags as $tag) {
                    $tagArray [] = $tag->name;
                }
                $tags = implode(',', $tagArray);
                update_tags($charge, $tags);
            }

            $newRecordsCount++;
        }

        return response()->json([
            'state' => 'success',
            'new_records_count' => $newRecordsCount,
        ]);
    }
}
