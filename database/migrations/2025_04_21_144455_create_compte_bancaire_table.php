<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Banque;
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
      

            // $table->unsignedBigInteger('id_User');
            // $table->foreign('id_User')->references('id')->on('users');
            $table->unsignedBigInteger('id_User');
            $table->foreign('id_User')->references('id')->on('users')->onDelete('cascade');

            // $table->unsignedBigInteger('id_Banque'); 
            // $table->foreign('id_Banque')->references('id_Banque')->on('Banque');
            $table->unsignedBigInteger('id_Banque');
            $table->foreign('id_Banque')->references('id_Banque')->on('banque')->onDelete('cascade');
 
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