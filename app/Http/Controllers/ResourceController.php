<?php

namespace App\Http\Controllers;

use App\Resource;
use App\Tag;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $resources = Resource::all();

        return view('resource.index', ['resources' => $resources]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('resource.create');
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
        $resource = new Resource;

        $this->save($resource, $request);

        return redirect()->route('resource.show', ['resource' => $resource]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Resource $resource
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Resource $resource)
    {
        return view('resource.show', ['resource' => $resource]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Resource $resource
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Resource $resource)
    {
        return view('resource.edit', ['resource' => $resource]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Resource $resource
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Resource $resource)
    {
        $this->save($resource, $request);

        return redirect()->route('resource.show', ['resource' => $resource]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Resource $resource
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resource $resource)
    {
        //
    }

    function save(Resource $resource, Request $request){
        $input = $request->all();

        $resource->name = $input['name'];
        $resource->description = $input['description'];
        $resource->main_material = $input['main_material'];
        $resource->origin = $input['origin'];
        $resource->commonality = $input['commonality'];
        $resource->value = $input['value'];
        $resource->save();

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
        $resource->tags()->sync($tagIDs);

        $resource->save();
    }
}
