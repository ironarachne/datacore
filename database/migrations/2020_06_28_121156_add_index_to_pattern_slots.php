<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToPatternSlots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pattern_slots', function (Blueprint $table) {
            $table->index('pattern_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pattern_slots', function (Blueprint $table) {
            $table->dropIndex('pattern_id');
        });
    }
}
