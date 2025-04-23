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
     
        Schema::create('compte_bancaire', function (Blueprint $table) {
            $table->id('id_Compte'); // * spécifier un nom de colonne
            $table->string('Nom_Compte', 300);  
            $table->decimal('solde_actuel', 20, 4);
            $table->string('Devise');
            $table->string('Iban');
            $table->string('Bic');

            // Clés étrangères
            $table->foreignId('id_User')->references('id_User')->on('users')->onDelete('cascade');
            $table->foreignId('id_Banque')->references('id_Banque')->on('banque')->onDelete('cascade');

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
        Schema::dropIfExists('compte_bancaire');
    }
};