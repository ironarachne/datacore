<?php

namespace App\Models;

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

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }
}
