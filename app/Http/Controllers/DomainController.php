<?php

namespace App\Http\Controllers;

use App\Domain;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        $domains = Domain::all();

        return view('domain.index', ['domains' => $domains]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('domain.create');
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
        $domain = new Domain;

        $this->save($domain, $request);

        return redirect()->route('domain.show', ['domain' => $domain]);
    }

    /**
     * Display the specified resource.
     *
     * @param Domain $domain
     *
     * @return Renderable
     */
    public function show(Domain $domain)
    {
        return view('domain.show', ['domain' => $domain]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Domain $domain
     *
     * @return Renderable
     */
    public function edit(Domain $domain)
    {
        return view('domain.edit', ['domain' => $domain]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Domain $domain
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Domain $domain)
    {
        $this->save($domain, $request);

        return redirect()->route('domain.show', ['domain' => $domain]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Domain $domain
     *
     * @return Response
     */
    public function destroy(Domain $domain)
    {
        //
    }

    function save(Domain $domain, Request $request)
    {
        $domain->name = $request->name;
        $domain->appearance_traits = $request->appearance_traits;
        $domain->personality_traits = $request->personality_traits;
        $domain->holy_items = $request->holy_items;
        $domain->holy_symbols = $request->holy_symbols;

        $domain->save();
    }
}
