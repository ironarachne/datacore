<?php

namespace App\Http\Controllers;

use App\Mineral;
use App\Resource;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MineralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        $minerals = Mineral::All();

        return view('mineral.index', ['minerals' => $minerals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('mineral.create');
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
        $mineral = new Mineral;

        $this->save($mineral, $request);

        return redirect()->route('mineral.show', ['mineral' => $mineral]);
    }

    /**
     * Display the specified resource.
     *
     * @param Mineral $mineral
     *
     * @return Renderable
     */
    public function show(Mineral $mineral)
    {
        return view('mineral.show', ['mineral' => $mineral]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Mineral $mineral
     *
     * @return Renderable
     */
    public function edit(Mineral $mineral)
    {
        $tags = convert_tags_to_string($mineral);

        return view('mineral.edit', ['mineral' => $mineral, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request  $request
     * @param Mineral  $mineral
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Mineral $mineral)
    {
        $this->save($mineral, $request);

        return redirect()->route('mineral.show', ['mineral' => $mineral]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Mineral  $mineral
     *
     * @return Response
     */
    public function destroy(Mineral $mineral)
    {
        //
    }

    public function save(Mineral $mineral, Request $request) {
        $input = $request->all();

        $mineral->name = $input['name'];
        $mineral->plural_name = $input['plural_name'];
        $mineral->hardness = $input['hardness'];
        $mineral->malleability = $input['malleability'];
        $mineral->commonality = $input['commonality'];

        $mineral->save();

        update_tags($mineral, $input['tags']);
    }

    // Resource functions

    public function createResource(Mineral $mineral) {
        return view('resource.create-for', ['item' => $mineral, 'itemType' => 'mineral']);
    }

    public function editResource(Mineral $mineral, Resource $resource) {
        $tags = convert_tags_to_string($resource);

        return view('resource.edit-for', ['item' => $mineral, 'itemType' => 'mineral', 'resource' => $resource, 'tags' => $tags]);
    }

    public function updateResource(Mineral $mineral, Resource $resource, Request $request) {
        $rc = new ResourceController();
        $rc->saveFor($mineral, $resource, $request);

        return redirect()->route('mineral.show', ['mineral' => $mineral]);
    }

    public function storeResource(Mineral $mineral, Request $request) {
        $resource = new Resource;

        $rc = new ResourceController();
        $rc->saveFor($mineral, $resource, $request);

        return redirect()->route('mineral.show', ['mineral' => $mineral]);
    }

    public function getJSON()
    {
        $minerals = Mineral::with('tags')->get()->toJSON();

        return response($minerals)->header('Content-Type', 'application/json');
    }
}
