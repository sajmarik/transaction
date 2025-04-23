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
        Schema::create('Echeance', function (Blueprint $table) {
            $table->id('id_Echeance'); // * spécifier un nom de colonne           
            $table->dateTime('Date_Echeance');
            $table->string('Statut',100);
            $table->string('Type_Echeance',length: 100);

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
        Schema::dropIfExists('echeance');
    }
};
