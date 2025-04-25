<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdCompteToRapprochementBancaireTable extends Migration
{
    public function up()
    {
        Schema::table('rapprochement_bancaire', function (Blueprint $table) {
            // Ajouter la colonne 'id_Compte'
            $table->unsignedBigInteger('id_Compte')->after('id_Transaction');

            // Ajouter la contrainte de clé étrangère pour 'id_Compte'
            $table->foreign('id_Compte')->references('id_Compte')->on('compte_bancaire')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('rapprochement_bancaire', function (Blueprint $table) {
            // Supprimer la clé étrangère et la colonne
            $table->dropForeign(['id_Compte']);
            $table->dropColumn('id_Compte');
        });
    }
}
