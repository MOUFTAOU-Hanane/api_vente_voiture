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
      if(Schema::hasColumn('vehicules','couleur_id'))
        Schema::table('vehicules', function (Blueprint $table) {
            $table->dropForeign('vehicules_couleur_id_foreign');
            $table->dropColumn('couleur_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table_vehicules', function (Blueprint $table) {
            //
        });
    }
};
