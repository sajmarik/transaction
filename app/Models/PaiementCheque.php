<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaiementCheque extends Model
{
    use HasFactory;



 // Spécifier que la clé primaire
 protected $primaryKey = 'id_Cheque';
       
 // Indiquer explicitement le nom de la tableprotected 
 protected $table = 'paiement_cheque';


 protected $fillable = [
          'Cheque_Numero',
          'Banque_Emettrice',
          'Nom_Titulaire',
          'Date_Emission',
          'id_Transaction',
        ];

    use SoftDeletes;  // Activer les suppressions douces
    protected $dates = ['deleted_at'];  // Indiquer que 'deleted_at' est un champ de type date



    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id_Transaction');
    }
    
}
