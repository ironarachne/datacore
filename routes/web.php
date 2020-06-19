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
Route::get('/', 'HomeController@index')->name('home');
Route::resource('biome', 'BiomeController');
Route::resource('charge', 'ChargeController');
Route::resource('domain', 'DomainController');
Route::resource('mineral', 'MineralController');
Route::resource('pattern', 'PatternController');
Route::resource('profession', 'ProfessionController');
Route::resource('resource', 'ResourceController');
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
