<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('species', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->unique();
            $table->string('plural_name');
            $table->string('adjective');
            $table->smallInteger('commonality', false, true);
            $table->smallInteger('humidity_min', false, true);
            $table->smallInteger('humidity_max', false, true);
            $table->smallInteger('temperature_min', false, true);
            $table->smallInteger('temperature_max', false, true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('species');
    }
}
