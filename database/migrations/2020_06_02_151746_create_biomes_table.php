<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biomes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->integer('fauna_prevalence', false, true);
            $table->integer('altitude_max', false, true);
            $table->integer('altitude_min', false, true);
            $table->integer('temperature_max', false, true);
            $table->integer('temperature_min', false, true);
            $table->integer('precipitation_max', false, true);
            $table->integer('precipitation_min', false, true);
            $table->integer('vegetation_prevalence', false, true);
            $table->string('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biomes');
    }
}
