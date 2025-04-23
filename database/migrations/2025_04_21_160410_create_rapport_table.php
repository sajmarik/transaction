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
        Schema::create('rapport', function (Blueprint $table) {
            $table->id('id_Rapport'); // * spécifier un nom de colonne
            $table->string('Type_Rapport');
            $table->dateTime('Date_generation');
 
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
        Schema::dropIfExists('rapport');
    }
};
