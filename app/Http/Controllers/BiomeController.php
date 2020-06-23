<?php

namespace App\Http\Controllers;

use App\Biome;
use App\Tag;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BiomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        $biomes = Biome::all();

        return view('biome.index', ['biomes' => $biomes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('biome.create');
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
        $biome = new Biome;

        $this->save($biome, $request);

        return redirect()->route('biome.show', ['biome' => $biome]);
    }

    /**
     * Display the specified resource.
     *
     * @param Biome $biome
     *
     * @return Renderable
     */
    public function show(Biome $biome)
    {
        return view('biome.show', ['biome' => $biome]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Biome $biome
     *
     * @return Renderable
     */
    public function edit(Biome $biome)
    {
        $tags = convert_tags_to_string($biome);

        return view('biome.edit', ['biome' => $biome, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Biome $biome
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Biome $biome)
    {
        $this->save($biome, $request);

        return redirect()->route('biome.show', ['biome' => $biome]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Biome $biome
     *
     * @return Response
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

        update_tags($biome, $input['tags']);

        $biome->save();
    }

    public function getJSON()
    {
        $biomes = Biome::with('tags')->get()->toJSON();

        $biomes = '{"biomes":' . $biomes. '}';

        return response($biomes)->header('Content-Type', 'application/json');
    }
}
