<?php

namespace App\Http\Controllers;

use App\Mineral;
use App\Resource;
use App\Tag;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(Request $request)
    {
        $tag = $request->tag;

        if (!empty($tag)) {
            $resources = Resource::withTag($tag)->orderBy('name')->paginate(15);
        } else {
            $resources = Resource::orderBy('name')->paginate(15);
        }

        return view('resource.index', ['resources' => $resources, 'tag' => $tag]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('resource.create');
    }

    public function json()
    {
        return view('resource.json');
    }

    public function search(Request $request)
    {
        $name = $request->input('name');

        $resources = Resource::where('name', 'like', "%$name%")->orderBy('name')->paginate(15);

        return view('resource.search', ['resources' => $resources]);
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
        $resource = new Resource;

        $this->save($resource, $request);

        return redirect()->route('resource.show', ['resource' => $resource]);
    }

    /**
     * Display the specified resource.
     *
     * @param Resource $resource
     *
     * @return Renderable
     */
    public function show(Resource $resource)
    {
        return view('resource.show', ['resource' => $resource]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Resource $resource
     *
     * @return Renderable
     */
    public function edit(Resource $resource)
    {
        return view('resource.edit', ['resource' => $resource]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Resource $resource
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Resource $resource)
    {
        $this->save($resource, $request);

        return redirect()->route('resource.show', ['resource' => $resource]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Resource $resource
     *
     * @return Response
     */
    public function destroy(Resource $resource)
    {
        //
    }

    function save(Resource $resource, Request $request)
    {
        $input = $request->all();

        $resource->name = $input['name'];
        $resource->description = $input['description'];
        $resource->main_material = $input['main_material'];
        $resource->origin = $input['origin'];
        $resource->commonality = $input['commonality'];
        $resource->value = $input['value'];
        $resource->save();

        update_tags($resource, $input['tags']);

        $resource->save();
    }

    public function saveFor($item, Resource $resource, Request $request)
    {
        $input = $request->all();

        $resource->name = $input['name'];
        $resource->description = $input['description'];
        $resource->main_material = $input['main_material'];
        $resource->origin = $item->name;
        $resource->commonality = $input['commonality'];
        $resource->value = $input['value'];

        $resource->save();

        $item->resources()->syncWithoutDetaching($resource->id);

        update_tags($resource, $input['tags']);
    }

    public function getJSON()
    {
        $resources = Resource::with('tags')->get()->toJSON();

        $resources = '{"resources":' . $resources . '}';

        return response($resources)->header('Content-Type', 'application/json');
    }
}
