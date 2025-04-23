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
        Schema::create('transaction', function (Blueprint $table) {
            $table->id('id_Transaction'); // * spécifier un nom de colonne
            $table->decimal('Transaction_Montant', 20, 4);  
            $table->dateTime('Date_Transaction');
            $table->string('Type_Transaction');
            $table->string('Description');
            $table->softDeletes();

            // Clés étrangères
            $table->foreignId('id_Compte')->references('id_Compte')->on('compte_bancaire')->onDelete('cascade');
            $table->foreignId('id_Echeance')->references('id_Echeance')->on('Echeance')->onDelete('cascade');
            $table->foreignId('id_Cat')->references('id_Cat')->on('Categorie')->onDelete('cascade');

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
        Schema::dropIfExists('transaction');
    }
};
