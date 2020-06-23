<?php

namespace App\Http\Controllers;

use App\Profession;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        $professions = Profession::all();

        return view('profession.index', ['professions' => $professions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('profession.create');
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
        $profession = new Profession;

        $this->save($profession, $request);

        return redirect()->route('profession.show', ['profession' => $profession]);
    }

    /**
     * Display the specified resource.
     *
     * @param Profession $profession
     *
     * @return Renderable
     */
    public function show(Profession $profession)
    {
        return view('profession.show', ['profession' => $profession]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Profession $profession
     *
     * @return Renderable
     */
    public function edit(Profession $profession)
    {
        $tags = convert_tags_to_string($profession);

        return view('profession.edit', ['profession' => $profession, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Profession $profession
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Profession $profession)
    {
        $this->save($profession, $request);

        return redirect()->route('profession.show', ['profession' => $profession]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Profession $profession
     *
     * @return Response
     */
    public function destroy(Profession $profession)
    {
        //
    }

    function save(Profession $profession, Request $request)
    {
        $profession->name = $request->name;
        $profession->description = $request->description;

        $profession->save();

        update_tags($profession, $request->tags);
    }

    public function getJSON()
    {
        $professions = Profession::with('tags')->get()->toJSON();

        $professions = '{"professions":' . $professions . '}';

        return response($professions)->header('Content-Type', 'application/json');
    }
}
