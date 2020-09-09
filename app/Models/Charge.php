<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    protected $fillable = [
        'descriptor',
        'identifier',
        'name',
        'noun',
        'noun_plural',
        'single_only',
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
