<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RapprochementBancaire extends Model
{
    use HasFactory;


    protected $table = 'rapprochement_bancaire'; // Spécifier le nom de la table
  protected $primaryKey = 'id_Rapprochement';      // Spécifier que la clé primaire 


  protected $fillable = [
    'Date_Rapprochement',
    'Solde_Reel',
    'Solde_Comptable',
    'Ecart',
    'id_Compte',
    'id_Transaction',
    ];

     use SoftDeletes;  // Activer les suppressions douces
     protected $dates = ['deleted_at'];  // Indiquer que 'deleted_at' est un champ de type date





    public function compte()
{
    return $this->belongsTo(Compte_bancaire::class, 'id_Compte');
}

public function transaction()
{
    return $this->belongsTo(Transaction::class, 'id_Transaction');
}


}
