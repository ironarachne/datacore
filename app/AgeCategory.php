<?php

namespace App;

use App\Dice;
use Illuminate\Database\Eloquent\Model;

class AgeCategory extends Model
{
    protected $fillable = [
        'name',
        'age_max',
        'age_min',
        'size_category',
        'height_base_female',
        'height_base_male',
        'height_range_dice',
        'weight_base_female',
        'weight_base_male',
        'weight_range_dice',
        'weight_modifier',
        'commonality',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'species_id',
    ];

    public function species() {
        return $this->belongsTo('App\Species');
    }

    private function averageHeight($gender) {
        $base = $this->height_base_female;

        if ($gender == 'male') {
            $base = $this->height_base_male;
        }

        $dice = new Dice($this->height_range_dice);

        $inches = $base + floor($dice->average());

        $height = inches_to_feet($inches);

        return $height;
    }

    public function averageFemaleHeight() {
        return $this->averageHeight('female');
    }

    public function averageMaleHeight() {
        return $this->averageHeight('male');
    }

    private function averageWeight($gender) {
        $base = $this->weight_base_female;

        if ($gender == 'male') {
            $base = $this->weight_base_male;
        }

        $dice = new Dice($this->weight_range_dice);

        return $base + floor($dice->average());
    }

    public function averageFemaleWeight() {
        return $this->averageWeight('female');
    }

    public function averageMaleWeight() {
        return $this->averageWeight('male');
    }
}
