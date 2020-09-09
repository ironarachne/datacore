<?php

namespace App\Models;

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
        return $this->morphToMany('App\Models\Resource', 'resourceable');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }
}
