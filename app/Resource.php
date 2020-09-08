<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
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

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'pivot',
    ];

    public static function withTag($tag)
    {
        return Resource::whereHas('tags', function (Builder $query) use ($tag) {
            $query->where('name', '=', $tag);
        });
    }

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    public function species()
    {
        return $this->morphedByMany('App\Species', 'resourceable');
    }
}
