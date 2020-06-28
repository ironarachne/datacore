<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToResourceables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resourceables', function (Blueprint $table) {
            $table->index('resource_id', 'resourceable_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resourceables', function (Blueprint $table) {
            $table->dropIndex('resource_id', 'resourceable_id');
        });
    }
}
