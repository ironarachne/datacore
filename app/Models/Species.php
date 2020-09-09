<?php

namespace App\Models;

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
        return $this->hasMany('App\Models\AgeCategory');
    }

    public function traitTemplates() {
        return $this->hasMany('App\Models\TraitTemplate');
    }

    public function resources() {
        return $this->morphToMany('App\Models\Resource', 'resourceable');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }
}
