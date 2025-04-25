<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction'; // Spécifier le nom de la table
  protected $primaryKey = 'id_Transaction';      // Spécifier que la clé primaire 


  protected $fillable = [
    'Transaction_Montant',
    'Date_Transaction',
    'Type_Transaction',
    'Description',
    'id_Compte',
    'id_Echeance',
    'id_Cat',
];

use SoftDeletes;  // Activer les suppressions douces
     protected $dates = ['deleted_at'];  // Indiquer que 'deleted_at' est un champ de type date



        public function compte()
        {
            return $this->belongsTo(Compte_bancaire::class, 'id_Compte');
        }
        
        public function user()
        {
            return $this->belongsTo(User::class, 'id_User');
        }
        
        public function categorie()
        {
            return $this->belongsTo(Categorie::class, 'id_Cat');
        }
        public function echeance()
        {
            return $this->belongsTo(Categorie::class, 'id_Echeance');
        }
        public function rapport()
        {
            return $this->belongsTo(Rapport::class, 'id_Rapport');
        }
        
        public function paiementCheque()
        {
            return $this->hasOne(PaiementCheque::class, 'id_Transaction');
        }
        
        public function paiementVirement()
        {
            return $this->hasOne(PaiementVirement::class, 'id_Transaction');
        }
        
}

