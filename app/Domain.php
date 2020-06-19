<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = [
        'name',
        'appearance_traits',
        'personality_traits',
        'holy_items',
        'holy_symbols',
    ];
}
