<?php

namespace App\Http\Controllers;

use App\Biome;
use App\Charge;
use App\Mineral;
use App\Pattern;
use App\Profession;
use App\Resource;
use App\Species;
use Illuminate\Contracts\Support\Renderable;

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
     * @return Renderable
     */
    public function index()
    {
        $biomeCount = Biome::count();
        $chargeCount = Charge::count();
        $mineralCount = Mineral::count();
        $patternCount = Pattern::count();
        $professionCount = Profession::count();
        $resourceCount = Resource::count();
        $speciesCount = Species::count();

        return view('home', [
            'biomeCount' => $biomeCount,
            'chargeCount' => $chargeCount,
            'mineralCount' => $mineralCount,
            'patternCount' => $patternCount,
            'professionCount' => $professionCount,
            'resourceCount' => $resourceCount,
            'speciesCount' => $speciesCount,
        ]);
    }
}
