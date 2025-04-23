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
        Schema::create('rapprochement_bancaire', function (Blueprint $table) {
            $table->id('id_Rapprochement'); // * spécifier un nom de colonne
            $table->dateTime('Date_Rapprochement'); 
            $table->decimal('Solde_Reel', 15, 2); 
            $table->decimal('Solde_Comptable', 15, 2); 
            $table->decimal('Ecart', 15, 2);

 
            $table->softDeletes();

            // Clés étrangères
            $table->foreignId('id_Transaction')->references('id_Transaction')->on('Transaction')->onDelete('cascade');
           
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
        Schema::dropIfExists('rapprochement_bancaire');
    }
};
