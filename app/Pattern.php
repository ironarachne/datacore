<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pattern extends Model
{
    protected $fillable = [
        'commonality',
        'description',
        'main_material',
        'main_material_override',
        'name',
        'name_template',
        'origin_override',
        'value',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'pivot',
    ];

    public function professions()
    {
        return $this->belongsToMany('App\Profession');
    }

    public function slots()
    {
        return $this->hasMany('App\PatternSlot');
    }

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
