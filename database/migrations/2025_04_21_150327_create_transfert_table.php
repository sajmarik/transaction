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
        Schema::create('transfert', function (Blueprint $table) {
            $table->id('id_Transfert'); // * spécifier un nom de colonne
            $table->decimal('Transfert_Montant', 20, 4);  
            $table->dateTime('Date_Transfert');
            $table->string('Ref_Transfert')->unique();
            $table->string('Type_Transfert');
            $table->string('Compte_destinataire');
            $table->softDeletes();

            // Clés étrangères
            $table->foreignId('id_Compte')->references('id_Compte')->on('compte_bancaire')->onDelete('cascade');
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
        Schema::dropIfExists('transfert');
    }
};
