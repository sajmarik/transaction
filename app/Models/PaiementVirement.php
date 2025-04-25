<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaiementVirement extends Model
{
    use HasFactory;




  // Spécifier que la clé primaire
  protected $primaryKey = 'id_Virement';
       
  // Indiquer explicitement le nom de la tableprotected 
  protected $table = 'paiement_virement';


  protected $fillable = [
           'Ref_Virement',
           'Compte_Destinataire',
           'id_Transaction',
  ];

     use SoftDeletes;  // Activer les suppressions douces
     protected $dates = ['deleted_at'];  // Indiquer que 'deleted_at' est un champ de type date









    public function transaction()
{
    return $this->belongsTo(Transaction::class, 'id_Transaction');
}


}
