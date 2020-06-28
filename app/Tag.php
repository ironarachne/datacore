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

    public function charges()
    {
        return $this->morphedByMany('App\Charge', 'taggable');
    }

    public function minerals()
    {
        return $this->morphedByMany('App\Mineral', 'taggable');
    }

    public function patterns()
    {
        return $this->morphedByMany('App\Pattern', 'taggable');
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
        return $this->morphedByMany('App\TraitTemplate', 'taggable');
    }
}
