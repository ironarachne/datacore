<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullablesToDomains extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('domains', function (Blueprint $table) {
            $table->string('personality_traits')->nullable()->change();
            $table->string('appearance_traits')->nullable()->change();
            $table->string('holy_items')->nullable()->change();
            $table->string('holy_symbols')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('domains', function (Blueprint $table) {
            $table->string('personality_traits')->nullable(false)->change();
            $table->string('appearance_traits')->nullable(false)->change();
            $table->string('holy_items')->nullable(false)->change();
            $table->string('holy_symbols')->nullable(false)->change();
        });
    }
}
