<?php

namespace App\Http\Controllers;

use App\Biome;
use App\Tag;
use Illuminate\Http\Request;

class BiomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $biomes = Biome::all();

        return view('biome.index', ['biomes' => $biomes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('biome.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $biome = new Biome;

        $this->save($biome, $request);

        return redirect()->route('biome.show', ['biome' => $biome]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Biome $biome
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Biome $biome)
    {
        return view('biome.show', ['biome' => $biome]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Biome $biome
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Biome $biome)
    {
        $tags = '';
        $tagData = $biome->tags()->get();

        foreach ($tagData as $tag) {
            $tags .= $tag->name . ',';
        }
        if (substr($tags, -1, 1) == ','){
            $tags = substr($tags, 0, -1);
        }

        return view('biome.edit', ['biome' => $biome, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Biome $biome
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Biome $biome)
    {
        $this->save($biome, $request);

        return redirect()->route('biome.show', ['biome' => $biome]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Biome $biome
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Biome $biome)
    {
        //
    }

    function save(Biome $biome, Request $request)
    {
        $input = $request->all();

        $biome->name = $input['name'];
        $biome->fauna_prevalence = $input['fauna_prevalence'];
        $biome->vegetation_prevalence = $input['vegetation_prevalence'];
        $biome->altitude_max = $input['altitude_max'];
        $biome->altitude_min = $input['altitude_min'];
        $biome->temperature_max = $input['temperature_max'];
        $biome->temperature_min = $input['temperature_min'];
        $biome->precipitation_max = $input['precipitation_max'];
        $biome->precipitation_min = $input['precipitation_min'];
        $biome->type = $input['type'];
        $biome->save();

        $tags = explode(',', $input['tags']);
        $tagIDs = [];
        foreach ($tags as $tag) {
            $t = Tag::where('name', '=', $tag)->first();
            if (empty($t)) {
                $newTag = Tag::create(['name' => $tag]);
                $newTag->save();
                $t = $newTag;
            }
            $tagIDs[] = $t->id;
        }
        $biome->tags()->sync($tagIDs);

        $biome->save();
    }
}
