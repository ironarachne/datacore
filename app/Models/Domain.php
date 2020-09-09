<?php

namespace App\Models;

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

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];
}
