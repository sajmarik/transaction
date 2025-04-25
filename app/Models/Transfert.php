<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transfert extends Model
{
    use HasFactory;
//    protected  $guarded=[];

  // Spécifier que la clé primaire
  protected $primaryKey = 'id_Transfert';
       
  // Indiquer explicitement le nom de la tableprotected 
  protected $table = 'transfert';


  protected $fillable = [
           'Transfert_Montant',
           'Date_Transfert',
           'Ref_Transfert',
           'Type_Transfert',
           'Compte_destinataire',
           'id_Compte',
  ];

     use SoftDeletes;  // Activer les suppressions douces
     protected $dates = ['deleted_at'];  // Indiquer que 'deleted_at' est un champ de type date



    public function compte()
{
    return $this->belongsTo(Compte_bancaire::class, 'id_Compte');
}


}
