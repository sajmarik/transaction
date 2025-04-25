<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToCategorieTable extends Migration
{
    public function up()
    {
        Schema::table('categorie', function (Blueprint $table) {
            $table->softDeletes(); // Ajoute la colonne deleted_at pour les suppressions douces
        });
    }

    public function down()
    {
        Schema::table('categorie', function (Blueprint $table) {
            $table->dropColumn('deleted_at'); // Si besoin de revenir en arrière
        });
    }
}
