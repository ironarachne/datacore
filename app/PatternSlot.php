<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatternSlot extends Model
{
    protected $fillable = [
        'name',
        'required_tag',
        'description_template',
        'possible_quirks',
    ];

    public function pattern() {
        return $this->belongsTo('App\Pattern');
    }
}
