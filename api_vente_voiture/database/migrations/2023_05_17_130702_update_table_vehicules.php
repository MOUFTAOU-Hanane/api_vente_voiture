<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('vehicules','annee'))
        Schema::table('vehicules', function (Blueprint $table) {

            $table->integer('annee')->change();


        });

        if(Schema::hasColumn('vehicules','est_actif'))
        Schema::table('vehicules', function (Blueprint $table) {

            $table->boolean('est_actif')->change();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
