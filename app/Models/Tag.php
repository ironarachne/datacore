<?php

namespace App\Models;

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
        return $this->morphedByMany('App\Models\Biome', 'taggable');
    }

    public function charges()
    {
        return $this->morphedByMany('App\Models\Charge', 'taggable');
    }

    public function minerals()
    {
        return $this->morphedByMany('App\Models\Mineral', 'taggable');
    }

    public function patterns()
    {
        return $this->morphedByMany('App\Models\Pattern', 'taggable');
    }

    public function professions()
    {
        return $this->morphedByMany('App\Models\Profession', 'taggable');
    }

    public function resources()
    {
        return $this->morphedByMany('App\Models\Resource', 'taggable');
    }

    public function species()
    {
        return $this->morphedByMany('App\Models\Species', 'taggable');
    }

    public function traitTemplates()
    {
        return $this->morphedByMany('App\Models\TraitTemplate', 'taggable');
    }
}
