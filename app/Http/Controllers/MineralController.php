<?php

namespace App\Http\Controllers;

use App\Models\Mineral;
use App\Models\Resource;
use App\Models\Tag;
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
        $minerals = Mineral::orderBy('name')->paginate(15);

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

    public function json()
    {
        return view('mineral.json');
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
     * @param Request $request
     * @param Mineral $mineral
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
     * @param Mineral $mineral
     *
     * @return Response
     */
    public function destroy(Mineral $mineral)
    {
        //
    }

    public function save(Mineral $mineral, Request $request)
    {
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

    public function createResource(Mineral $mineral)
    {
        return view('resource.create-for', ['item' => $mineral, 'itemType' => 'mineral']);
    }

    public function editResource(Mineral $mineral, Resource $resource)
    {
        $tags = convert_tags_to_string($resource);

        return view('resource.edit-for', ['item' => $mineral, 'itemType' => 'mineral', 'resource' => $resource, 'tags' => $tags]);
    }

    public function updateResource(Mineral $mineral, Resource $resource, Request $request)
    {
        $rc = new ResourceController();
        $rc->saveFor($mineral, $resource, $request);

        return redirect()->route('mineral.show', ['mineral' => $mineral]);
    }

    public function storeResource(Mineral $mineral, Request $request)
    {
        $resource = new Resource;

        $rc = new ResourceController();
        $rc->saveFor($mineral, $resource, $request);

        return redirect()->route('mineral.show', ['mineral' => $mineral]);
    }

    public function getJSON(Request $request)
    {
        if (!empty($request->query('tag'))) {
            $tag = Tag::where('name', '=', $request->query('tag'))->first();
            if (empty($tag)) {
                return response('{"minerals": []}')->header('Content-Type', 'application/json');
            }
            $minerals = $tag->minerals()->with(['tags', 'resources.tags'])->get()->toJson();
        } else {
            $minerals = Mineral::with(['tags', 'resources.tags'])->get()->toJSON();
        }

        $minerals = '{"minerals":' . $minerals . '}';

        return response($minerals)->header('Content-Type', 'application/json');
    }

    public function storeFromJson(Request $request)
    {
        $data = json_decode($request->data);

        if (empty($data->minerals)) {
            return response('invalid data for mineral', '400');
        }

        $newRecordsCount = 0;

        foreach ($data->minerals as $object) {
            $mineral = new Mineral;

            $mineral->name = $object->name;
            $mineral->plural_name = $object->plural_name;
            $mineral->hardness = $object->hardness;
            $mineral->malleability = $object->malleability;
            $mineral->commonality = $object->commonality;

            $mineral->save();

            if (!empty($object->resources)) {
                foreach ($object->resources as $r) {
                    $resource = new Resource;
                    $resource->name = $r->name;
                    $resource->description = $r->description;
                    $resource->main_material = $r->main_material;
                    $resource->origin = $r->origin;
                    $resource->commonality = $r->commonality;
                    $resource->value = $r->value;
                    $mineral->resources()->save($resource);
                    $tagArray = [];
                    foreach ($r->tags as $tag) {
                        $tagArray [] = $tag->name;
                    }
                    $rTags = implode(',', $tagArray);
                    update_tags($resource, $rTags);
                }
            }

            if (sizeof($object->tags) > 0) {
                $tagArray = [];
                foreach ($object->tags as $tag) {
                    $tagArray [] = $tag->name;
                }
                $tags = implode(',', $tagArray);
                update_tags($mineral, $tags);
            }

            $newRecordsCount++;
        }

        return response()->json([
            'state' => 'success',
            'new_records_count' => $newRecordsCount,
        ]);
    }
}
