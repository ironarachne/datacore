<?php

namespace App\Http\Controllers;

use App\AgeCategory;
use App\Resource;
use App\Species;
use App\Tag;
use App\TraitTemplate;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SpeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(Request $request)
    {
        if (!empty($request->query('tag'))) {
            $tag = Tag::where('name', '=', $request->query('tag'))->first();
            if (empty($tag)) {
                $species = [];
            } else {
                $species = $tag->species()->orderBy('name')->get();
            }
        } else {
            $species = Species::orderBy('name')->get();
        }

        return view('species.index', ['species' => $species]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('species.create');
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
        $species = new Species;

        $this->save($species, $request);

        return redirect()->route('species.show', ['species' => $species]);
    }

    /**
     * Display the specified resource.
     *
     * @param Species $species
     *
     * @return Renderable
     */
    public function show(Species $species)
    {
        return view('species.show', ['species' => $species]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Species $species
     *
     * @return Renderable
     */
    public function edit(Species $species)
    {
        $tags = convert_tags_to_string($species);

        return view('species.edit', ['species' => $species, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request  $request
     * @param Species  $species
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Species $species)
    {
        $this->save($species, $request);

        return redirect()->route('species.show', ['species' => $species]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Species  $species
     *
     * @return Response
     */
    public function destroy(Species $species)
    {
        //
    }

    public function save(Species $species, Request $request) {
        $input = $request->all();

        $species->name = $input['name'];
        $species->plural_name = $input['plural_name'];
        $species->adjective = $input['adjective'];
        $species->commonality = $input['commonality'];
        $species->humidity_min = $input['humidity_min'];
        $species->humidity_max = $input['humidity_max'];
        $species->temperature_min = $input['temperature_min'];
        $species->temperature_max = $input['temperature_max'];

        $species->save();

        update_tags($species, $input['tags']);
    }

    // Shortcut functions

    public function storeQuickRace(Request $request) {
        $species = new Species;
        $input = $request->all();

        if (empty($input['name'])) {
            return response('error: name must be set', 500);
        }

        $species->name = $input['name'];
        $species->plural_name = $species->name . 's';
        $species->adjective = $species->name;
        $species->commonality = 100;
        $species->humidity_min = 0;
        $species->humidity_max = 0;
        $species->temperature_min = 0;
        $species->temperature_max = 0;

        $species->save();

        update_tags($species, $species->name.',sentient,race');

        $infant = new AgeCategory;
        $infant->name = 'infant';
        $infant->age_min = 0;
        $infant->age_max = 1;
        $infant->height_base_female = 18;
        $infant->height_base_male = 18;
        $infant->height_range_dice = '2d8';
        $infant->weight_base_female = 5;
        $infant->weight_base_male = 5;
        $infant->weight_range_dice = '2d10';
        $infant->size_category = 'tiny';
        $infant->commonality = 1;

        $child = new AgeCategory;
        $child->name = 'child';
        $child->age_min = 2;
        $child->age_max = 12;
        $child->height_base_female = 42;
        $child->height_base_male = 42;
        $child->height_range_dice = '2d8';
        $child->weight_base_female = 36;
        $child->weight_base_male = 36;
        $child->weight_range_dice = '2d10';
        $child->size_category = 'small';
        $child->commonality = 10;

        $teenager = new AgeCategory;
        $teenager->name = 'teenager';
        $teenager->age_min = 13;
        $teenager->age_max = 19;
        $teenager->height_base_female = 57;
        $teenager->height_base_male = 62;
        $teenager->height_range_dice = '2d8';
        $teenager->weight_base_female = 89;
        $teenager->weight_base_male = 92;
        $teenager->weight_range_dice = '2d10';
        $teenager->size_category = 'medium';
        $teenager->commonality = 30;

        $youngAdult = new AgeCategory;
        $youngAdult->name = 'young adult';
        $youngAdult->age_min = 20;
        $youngAdult->age_max = 25;
        $youngAdult->height_base_female = 57;
        $youngAdult->height_base_male = 62;
        $youngAdult->height_range_dice = '2d8';
        $youngAdult->weight_base_female = 105;
        $youngAdult->weight_base_male = 140;
        $youngAdult->weight_range_dice = '2d10';
        $youngAdult->size_category = 'medium';
        $youngAdult->commonality = 100;

        $adult = new AgeCategory;
        $adult->name = 'adult';
        $adult->age_min = 26;
        $adult->age_max = 69;
        $adult->height_base_female = 57;
        $adult->height_base_male = 62;
        $adult->height_range_dice = '2d8';
        $adult->weight_base_female = 105;
        $adult->weight_base_male = 140;
        $adult->weight_range_dice = '2d10';
        $adult->size_category = 'medium';
        $adult->commonality = 150;

        $elderly = new AgeCategory;
        $elderly->name = 'elderly';
        $elderly->age_min = 70;
        $elderly->age_max = 100;
        $elderly->height_base_female = 57;
        $elderly->height_base_male = 62;
        $elderly->height_range_dice = '2d8';
        $elderly->weight_base_female = 105;
        $elderly->weight_base_male = 140;
        $elderly->weight_range_dice = '2d10';
        $elderly->size_category = 'medium';
        $elderly->commonality = 150;

        $species->ageCategories()->saveMany([$infant, $child, $teenager, $youngAdult, $adult, $elderly]);

        return response()->json($species);
    }

    // Resource functions

    public function createResource(Species $species) {
        return view('resource.create-for', ['item' => $species, 'itemType' => 'species']);
    }

    public function editResource(Species $species, Resource $resource) {
        $tags = convert_tags_to_string($resource);

        return view('resource.edit-for', ['item' => $species, 'itemType' => 'species', 'resource' => $resource, 'tags' => $tags]);
    }

    public function updateResource(Species $species, Resource $resource, Request $request) {
        $rc = new ResourceController();
        $rc->saveFor($species, $resource, $request);

        return redirect()->route('species.show', ['species' => $species]);
    }

    public function storeResource(Species $species, Request $request) {
        $resource = new Resource;

        $rc = new ResourceController();
        $rc->saveFor($species, $resource, $request);

        return redirect()->route('species.show', ['species' => $species]);
    }

    // Age Category functions

    public function createAgeCategory(Species $species) {
        return view('species.age_category.create', ['species' => $species]);
    }

    public function editAgeCategory(Species $species, AgeCategory $ageCategory) {
        return view('species.age_category.edit', ['species' => $species, 'ageCategory' => $ageCategory]);
    }

    public function updateAgeCategory(Species $species, AgeCategory $ageCategory, Request $request) {
        $this->saveAgeCategory($species, $ageCategory, $request);

        return redirect()->route('species.show', ['species' => $species]);
    }

    public function storeAgeCategory(Species $species, Request $request) {
        $ageCategory = new AgeCategory;

        $this->saveAgeCategory($species, $ageCategory, $request);

        return redirect()->route('species.show', ['species' => $species]);
    }

    public function saveAgeCategory(Species $species, AgeCategory $ageCategory, Request $request) {
        $input = $request->all();

        $ageCategory->name = $input['name'];
        $ageCategory->age_min = $input['age_min'];
        $ageCategory->age_max = $input['age_max'];
        $ageCategory->size_category = $input['size_category'];
        $ageCategory->height_base_female = $input['height_base_female'];
        $ageCategory->height_base_male = $input['height_base_male'];
        $ageCategory->height_range_dice = $input['height_range_dice'];
        $ageCategory->weight_base_female = $input['weight_base_female'];
        $ageCategory->weight_base_male = $input['weight_base_male'];
        $ageCategory->weight_range_dice = $input['weight_range_dice'];
        $ageCategory->commonality = $input['commonality'];

        $species->ageCategories()->save($ageCategory);
    }

    // Trait Template functions

    public function createTraitTemplate(Species $species) {
        return view('species.trait_template.create', ['species' => $species]);
    }

    public function editTraitTemplate(Species $species, TraitTemplate $traitTemplate) {
        $tags = convert_tags_to_string($traitTemplate);

        return view('species.trait_template.edit', ['species' => $species, 'traitTemplate' => $traitTemplate, 'tags' => $tags]);
    }

    public function updateTraitTemplate(Species $species, TraitTemplate $traitTemplate, Request $request) {
        $this->saveTraitTemplate($species, $traitTemplate, $request);

        return redirect()->route('species.show', ['species' => $species]);
    }

    public function storeTraitTemplate(Species $species, Request $request) {
        $traitTemplate = new TraitTemplate;

        $this->saveTraitTemplate($species, $traitTemplate, $request);

        return redirect()->route('species.show', ['species' => $species]);
    }

    public function saveTraitTemplate(Species $species, TraitTemplate $traitTemplate, Request $request) {
        $input = $request->all();

        $traitTemplate->name = $input['name'];
        $traitTemplate->possible_values = $input['possible_values'];
        $traitTemplate->possible_descriptors = $input['possible_descriptors'];
        $traitTemplate->trait_type = $input['trait_type'];

        $species->traitTemplates()->save($traitTemplate);

        update_tags($traitTemplate, $input['tags']);
    }

    public function getJSON(Request $request)
    {
        if (!empty($request->query('tag'))) {
            $tag = Tag::where('name', '=', $request->query('tag'))->first();
            if (empty($tag)) {
                return response('{"species": []}')->header('Content-Type', 'application/json');
            }
            $species = $tag->species()->with(['tags', 'traitTemplates', 'resources', 'ageCategories'])->get()->toJSON();
        } else {
            $species = Species::with(['tags', 'traitTemplates', 'resources', 'ageCategories'])->get()->toJSON();
        }

        $species = '{"species":' . $species . '}';

        return response($species)->header('Content-Type', 'application/json');
    }

    public function storeFromJson(Request $request)
    {
        $data = json_decode($request->data);

        if (empty($data->species)) {
            return response('invalid data for species', '400');
        }

        $newRecordsCount = 0;

        foreach($data->species as $object) {
            $species = new Species;

            $species->name = $object->name;
            $species->plural_name = $object->plural_name;
            $species->adjective = $object->adjective;
            $species->commonality = $object->commonality;
            $species->humidity_max = $object->max_humidity;
            $species->humidity_min = $object->min_humidity;
            $species->temperature_max = $object->max_temperature;
            $species->temperature_min = $object->min_temperature;

            $species->save();

            if (!empty($object->age_categories)) {
                foreach($object->age_categories as $ac) {
                    $ageCategory = new AgeCategory;
                    $ageCategory->name = $ac->name;
                    $ageCategory->age_min = $ac->age_min;
                    $ageCategory->age_max = $ac->age_max;
                    $ageCategory->commonality = $ac->commonality;
                    $ageCategory->height_base_female = $ac->female_height_base;
                    $ageCategory->height_base_male = $ac->male_height_base;
                    $ageCategory->height_range_dice = $ac->height_range_dice->number . 'd' . $ac->height_range_dice->sides;
                    $ageCategory->weight_base_female = $ac->female_weight_base;
                    $ageCategory->weight_base_male = $ac->male_weight_base;
                    $ageCategory->weight_range_dice = $ac->weight_range_dice->number . 'd' . $ac->weight_range_dice->sides;
                    $ageCategory->size_category = $ac->size_category->name;
                    $species->ageCategories()->save($ageCategory);
                }
            }

            if (!empty($object->possible_traits)) {
                foreach($object->possible_traits as $t) {
                    $trait = new TraitTemplate;
                    $trait->name = $t->name;
                    $trait->possible_values = implode(',', $t->possible_values);
                    $trait->possible_descriptors = implode(',', $t->possible_descriptors);
                    $trait->trait_type = 'possible';
                    $species->traitTemplates()->save($trait);
                    $tTags = implode(',', $t->tags);
                    update_tags($trait, $tTags);
                }
            }

            if (!empty($object->common_traits)) {
                foreach($object->common_traits as $t) {
                    $trait = new TraitTemplate;
                    $trait->name = $t->name;
                    $trait->possible_values = implode(',', $t->possible_values);
                    $trait->possible_descriptors = implode(',', $t->possible_descriptors);
                    $trait->trait_type = 'common';
                    $species->traitTemplates()->save($trait);
                    $tTags = implode(',', $t->tags);
                    update_tags($trait, $tTags);
                }
            }

            if (!empty($object->resources)) {
                foreach($object->resources as $r) {
                    $resource = new Resource;
                    $resource->name = $r->name;
                    $resource->description = $r->description;
                    $resource->main_material = $r->main_material;
                    $resource->origin = $r->origin;
                    $resource->commonality = $r->commonality;
                    $resource->value = $r->value;
                    $species->resources()->save($resource);
                    $rTags = implode(',', $r->tags);
                    update_tags($resource, $rTags);
                }
            }

            if (sizeof($object->tags) > 0) {
                $tags = implode(',', $object->tags);
                update_tags($species, $tags);
            }

            $newRecordsCount++;
        }

        return response()->json([
            'state' => 'success',
            'new_records_count' => $newRecordsCount,
        ]);
    }
}
