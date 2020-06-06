<?php

namespace App\Http\Controllers;

use App\Biome;
use App\Profession;
use App\Resource;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $biomeCount = Biome::count();
        $professionCount = Profession::count();
        $resourceCount = Resource::count();

        return view('home', [
            'biomeCount' => $biomeCount,
            'professionCount' => $professionCount,
            'resourceCount' => $resourceCount,
        ]);
    }
}
