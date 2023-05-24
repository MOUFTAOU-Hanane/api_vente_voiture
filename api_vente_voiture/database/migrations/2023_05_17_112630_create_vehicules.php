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
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
          $table->bigInteger('marque_id')->unsigned();
              
            $table->bigInteger('type_vehicule_id')->unsigned();
            $table->foreign('type_vehicule_id')->references('id')->on('types_vehicule');
            $table->bigInteger('modele_id')->unsigned();
            $table->foreign('modele_id')->references('id')->on('modeles');
            $table->dateTime("annee");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicules');
    }
};
