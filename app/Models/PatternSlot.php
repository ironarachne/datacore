<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatternSlot extends Model
{
    protected $fillable = [
        'name',
        'required_tag',
        'description_template',
        'possible_quirks',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'pattern_id',
    ];

    public function pattern() {
        return $this->belongsTo('App\Pattern');
    }
}
