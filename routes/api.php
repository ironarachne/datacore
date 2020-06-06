<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/biomes', function () {
    $data = App\Biome::with('tags')->get();

    $biomes = [];

    foreach ($data as $biome) {
        $tags = [];

        foreach ($biome->tags as $tag) {
            $tags[] = $tag->name;
        }

        $biomes[] = [
            'name' => $biome->name,
            'vegetation_prevalence' => $biome->vegetation_prevalence,
            'fauna_prevalence' => $biome->fauna_prevalence,
            'temperature_max' => $biome->temperature_max,
            'temperature_min' => $biome->temperature_min,
            'altitude_max' => $biome->altitude_max,
            'altitude_min' => $biome->altitude_min,
            'precipitation_max' => $biome->precipitation_max,
            'precipitation_min' => $biome->precipitation_min,
            'type' => $biome->type,
            'tags' => $tags,
        ];
    }

    return response()->json($biomes);
});
