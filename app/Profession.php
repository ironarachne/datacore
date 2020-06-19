<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function patterns()
    {
        return $this->hasMany('App\Pattern');
    }

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
