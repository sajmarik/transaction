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
        Schema::create('paiement_cheque', function (Blueprint $table) {
            $table->id('id_Cheque'); // * spécifier un nom de colonne
            $table->string('Cheque_Numero');
            $table->string('Banque_Emettrice');
            $table->string('Nom_Titulaire');
            $table->dateTime('Date_Emission');
 
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
        Schema::dropIfExists('paiement_cheque');
    }
};
