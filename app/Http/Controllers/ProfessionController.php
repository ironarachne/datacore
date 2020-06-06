<?php

namespace App\Http\Controllers;

use App\Profession;
use App\Tag;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $professions = Profession::all();

        return view('profession.index', ['professions' => $professions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('profession.create');
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
        $profession = new Profession;

        $this->save($profession, $request);

        return redirect()->route('profession.show', ['profession' => $profession]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Profession $profession
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Profession $profession)
    {
        return view('profession.show', ['profession' => $profession]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Profession $profession
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Profession $profession)
    {
        $tags = '';
        $tagData = $profession->tags()->get();

        foreach ($tagData as $tag) {
            $tags .= $tag->name.',';
        }
        if (substr($tags, -1, 1) == ',') {
            $tags = substr($tags, 0, -1);
        }

        return view('profession.edit', ['profession' => $profession, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Profession $profession
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Profession $profession)
    {
        $this->save($profession, $request);

        return redirect()->route('profession.show', ['profession' => $profession]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Profession $profession
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profession $profession)
    {
        //
    }

    function save(Profession $profession, Request $request)
    {
        $input = $request->all();

        $profession->name = $input['name'];
        $profession->description = $input['description'];

        $profession->save();

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
        $profession->tags()->sync($tagIDs);

        $profession->save();
    }
}
