<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgeCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('age_categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->unsignedBigInteger('species_id');
            $table->integer('age_max')->unsigned();
            $table->integer('age_min')->unsigned();
            $table->string('size_category');
            $table->integer('height_base_female')->unsigned();
            $table->integer('height_base_male')->unsigned();
            $table->string('height_range_dice');
            $table->integer('weight_base_female')->unsigned();
            $table->integer('weight_base_male')->unsigned();
            $table->string('weight_range_dice');
            $table->smallInteger('commonality', false, true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('age_categories');
    }
}
