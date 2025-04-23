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
        Schema::create('Banque', function (Blueprint $table) {
            $table->id('id_Banque'); // * spécifier un nom de colonne           
            $table->string('Nom_Banque',50)->nullable();
            $table->string('Code_Bic',70)->unique();
            $table->string('Adresse_Siege',200);
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
        Schema::dropIfExists('banque');
    }
};
