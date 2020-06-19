<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mineral extends Model
{
    protected $fillable = [
        'name',
        'plural_name',
        'hardness',
        'malleability',
        'commonality',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function resources() {
        return $this->morphToMany('App\Resource', 'resourceable');
    }

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
