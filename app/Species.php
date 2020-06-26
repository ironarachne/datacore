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
}
