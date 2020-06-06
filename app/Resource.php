<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'name',
        'description',
        'main_material',
        'origin',
        'commonality',
        'value',
    ];

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
