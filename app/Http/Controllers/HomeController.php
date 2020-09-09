<?php

namespace App\Http\Controllers;

use App\Models\Biome;
use App\Models\Charge;
use App\Models\Domain;
use App\Models\Mineral;
use App\Models\Pattern;
use App\Models\Profession;
use App\Models\Resource;
use App\Models\Species;
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
        $domainCount = Domain::count();
        $mineralCount = Mineral::count();
        $patternCount = Pattern::count();
        $professionCount = Profession::count();
        $resourceCount = Resource::count();
        $speciesCount = Species::count();

        return view('home', [
            'biomeCount' => $biomeCount,
            'chargeCount' => $chargeCount,
            'domainCount' => $domainCount,
            'mineralCount' => $mineralCount,
            'patternCount' => $patternCount,
            'professionCount' => $professionCount,
            'resourceCount' => $resourceCount,
            'speciesCount' => $speciesCount,
        ]);
    }
}
