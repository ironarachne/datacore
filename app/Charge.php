<?php

namespace App;

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

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
