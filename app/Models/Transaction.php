<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction'; // Spécifier le nom de la table{
        public function compte()
        {
            return $this->belongsTo(CompteBancaire::class, 'id_Compte');
        }
        
        public function user()
        {
            return $this->belongsTo(User::class, 'id_User');
        }
        
        public function categorie()
        {
            return $this->belongsTo(Categorie::class, 'id_Categorie');
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

