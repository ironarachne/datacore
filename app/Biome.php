<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biome extends Model
{
    protected $attributes = [
        'type' => 'terrestrial',
    ];

    protected $fillable = [
        'name',
        'type',
        'fauna_prevalence',
        'vegetation_prevalence',
        'altitude_max',
        'altitude_min',
        'precipitation_max',
        'precipitation_min',
        'temperature_max',
        'temperature_min',
    ];

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
