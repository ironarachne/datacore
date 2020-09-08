<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/biome/json', 'BiomeController@json')->name('biome.json');
    Route::resource('biome', 'BiomeController');
    Route::get('/charge/json', 'ChargeController@json')->name('charge.json');
    Route::post('/charge/search', 'ChargeController@search')->name('charge.search');
    Route::resource('charge', 'ChargeController');
    Route::get('/domain/json', 'DomainController@json')->name('domain.json');
    Route::resource('domain', 'DomainController');
    Route::get('/mineral/json', 'MineralController@json')->name('mineral.json');
    Route::resource('mineral', 'MineralController');
    Route::get('/pattern/json', 'PatternController@json')->name('pattern.json');
    Route::post('/pattern/search', 'PatternController@search')->name('pattern.search');
    Route::resource('pattern', 'PatternController');
    Route::get('/profession/json', 'ProfessionController@json')->name('profession.json');
    Route::resource('profession', 'ProfessionController');
    Route::get('/resource/json', 'ResourceController@json')->name('resource.json');
    Route::post('/resource/search', 'ResourceController@search')->name('resource.search');
    Route::resource('resource', 'ResourceController');
    Route::get('/species/json', 'SpeciesController@json')->name('species.json');
    Route::get('/species/quick', 'SpeciesController@quick')->name('species.quick');
    Route::post('/species/search', 'SpeciesController@search')->name('species.search');
    Route::resource('species', 'SpeciesController');

    // Pattern routes
    Route::get('pattern/{pattern}/slot/create', 'PatternController@createSlot')->name('pattern.create_slot');
    Route::get('pattern/{pattern}/slot/{slot}/edit', 'PatternController@editSlot')->name('pattern.edit_slot');
    Route::post('pattern/{pattern}/slot', 'PatternController@storeSlot')->name('pattern.store_slot');
    Route::put('pattern/{pattern}/slot/{slot}', 'PatternController@updateSlot')->name('pattern.update_slot');

    // Species routes
    Route::get('species/{species}/resource/create', 'SpeciesController@createResource')->name('species.create_resource');
    Route::get('species/{species}/resource/{resource}/edit', 'SpeciesController@editResource')->name('species.edit_resource');
    Route::post('species/{species}/resource', 'SpeciesController@storeResource')->name('species.store_resource');
    Route::put('species/{species}/resource/{resource}', 'SpeciesController@updateResource')->name('species.update_resource');

    Route::get('species/{species}/age_category/create', 'SpeciesController@createAgeCategory')->name('species.create_age_category');
    Route::get('species/{species}/age_category/{age_category}/edit', 'SpeciesController@editAgeCategory')->name('species.edit_age_category');
    Route::post('species/{species}/age_category', 'SpeciesController@storeAgeCategory')->name('species.store_age_category');
    Route::put('species/{species}/age_category/{age_category}', 'SpeciesController@updateAgeCategory')->name('species.update_age_category');

    Route::get('species/{species}/trait_template/create', 'SpeciesController@createTraitTemplate')->name('species.create_trait_template');
    Route::get('species/{species}/trait_template/{trait_template}/edit', 'SpeciesController@editTraitTemplate')->name('species.edit_trait_template');
    Route::post('species/{species}/trait_template', 'SpeciesController@storeTraitTemplate')->name('species.store_trait_template');
    Route::put('species/{species}/trait_template/{trait_template}', 'SpeciesController@updateTraitTemplate')->name('species.update_trait_template');

    Route::post('quick/race', 'SpeciesController@storeQuickRace')->name('quick.race');

    // Mineral routes
    Route::get('mineral/{mineral}/resource/create', 'MineralController@createResource')->name('mineral.create_resource');
    Route::get('mineral/{mineral}/resource/{resource}/edit', 'MineralController@editResource')->name('mineral.edit_resource');
    Route::post('mineral/{mineral}/resource', 'MineralController@storeResource')->name('mineral.store_resource');
    Route::put('mineral/{mineral}/resource/{resource}', 'MineralController@updateResource')->name('mineral.update_resource');
});
