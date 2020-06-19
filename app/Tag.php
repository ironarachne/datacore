<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'pivot',
    ];

    public function biomes()
    {
        return $this->morphedByMany('App\Biome', 'taggable');
    }

    public function professions()
    {
        return $this->morphedByMany('App\Profession', 'taggable');
    }

    public function resources()
    {
        return $this->morphedByMany('App\Resource', 'taggable');
    }

    public function species()
    {
        return $this->morphedByMany('App\Species', 'taggable');
    }

    public function traitTemplates()
    {
        return $this->morphedByMany('App\Species', 'taggable');
    }
}
