<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TraitTemplate extends Model
{
    protected $fillable = [
        'name',
        'possible_values',
        'possible_descriptors',
        'trait_type',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'species_id',
    ];

    public function species()
    {
        return $this->belongsTo('App\Models\Species');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }
}
