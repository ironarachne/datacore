<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    protected $fillable = [
        'name',
        'plural_name',
        'adjective',
        'commonality',
        'temperature_max',
        'temperature_min',
        'humidity_max',
        'humidity_min',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function ageCategories() {
        return $this->hasMany('App\AgeCategory');
    }

    public function traitTemplates() {
        return $this->hasMany('App\TraitTemplate');
    }

    public function resources() {
        return $this->morphToMany('App\Resource', 'resourceable');
    }

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
    
    public static function fromJSON($json) {
        $object = json_decode($json);
        
        $species = new Species;
        
        $species->name = $object['name'];
        $species->plural_name = $object['plural_name'];
        $species->adjective = $object['adjective'];
        $species->commonality = $object['commonality'];
        $species->max_humidity = $object['max_humidity'];
        $species->min_humidity = $object['min_humidity'];
        $species->max_temperature = $object['max_temperature'];
        $species->min_temperature = $object['min_temperature'];
        
        $species->save();
        
        if (sizeof($object['age_categories']) > 0 ) {
            foreach($object['age_categories'] as $ac) {
                $ageCategory = new AgeCategory;
                $ageCategory->name = $ac['name'];
                $ageCategory->age_min = $ac['age_min'];
                $ageCategory->age_max = $ac['age_max'];
                $ageCategory->height_base_female = $ac['female_height_base'];
                $ageCategory->height_base_male = $ac['male_height_base'];
                $ageCategory->height_range_dice = $ac['height_range_dice']['number'] . 'd' . $ac['height_range_dice']['sides'];
                $ageCategory->weight_base_female = $ac['female_weight_base'];
                $ageCategory->weight_base_male = $ac['male_weight_base'];
                $ageCategory->weight_range_dice = $ac['weight_range_dice']['number'] . 'd' . $ac['weight_range_dice']['sides'];
                $ageCategory->size_category = $ac['size_category']['name'];
                $species->ageCategories()->save($ageCategory);
            }
        }
        
        if (sizeof($object['possible_traits']) > 0) {
            foreach($object['possible_traits'] as $t) {
                $trait = new Trait;
                $tTags = [];
                $trait->name = $t['name'];
                $trait->possible_values = implode(',', $t['possible_values']);
                $trait->possible_descriptors = implode(',', $t['possible_descriptors']);
                $trait->trait_type = 'possible';
                $species->traitTemplates()->save($trait);
                $tTags = implode(',', $t['tags']);
                update_tags($trait, $tTags);
            }
        }
        
        if (sizeof($object['common_traits']) > 0) {
            foreach($object['common_traits'] as $t) {
                $trait = new Trait;
                $tTags = [];
                $trait->name = $t['name'];
                $trait->possible_values = implode(',', $t['possible_values']);
                $trait->possible_descriptors = implode(',', $t['possible_descriptors']);
                $trait->trait_type = 'common';
                $species->traitTemplates()->save($trait);
                $tTags = implode(',', $t['tags']);
                update_tags($trait, $tTags);
            }
        }
        
        if (sizeof($object['resources']) > 0) {
            foreach($object['resources'] as $r) {
                $resource = new Resource;
                $resource->name = $r['name'];
                $resource->description = $r['description'];
                $resource->main_material = $r['main_material'];
                $resource->origin = $r['origin'];
                $resource->commonality = $r['commonality'];
                $resource->value = $r['value'];
                $species->resources()->save($resource);
                $rTags = implode(',', $r['tags']);
                update_tags($resource, $rTags);
            }
        }
        
        if (sizeof($object['tags']) > 0) {
            $tags = implode(',', $object['tags']);
            update_tags($species, $tags);
        }
        
        return $species;
    }
}
