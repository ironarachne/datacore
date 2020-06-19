<?php

namespace App\Http\Controllers;

use App\Charge;
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
        $charges = Charge::all();

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

        $charge->save();

        update_tags($charge, $request->tags);
    }
}
