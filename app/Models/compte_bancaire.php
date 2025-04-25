<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class compte_bancaire extends Model
{
    use HasFactory;

     // Spécifier que la clé primaire
     protected $primaryKey = 'id_Compte';
       
     // Indiquer explicitement le nom de la table
     protected $table = 'compte_bancaire'; 
     protected $fillable = [
         'Nom_Compte',
         'solde_actuel',
         'Devise',
         'Iban',
         'Bic',
         'id_User',
    'id_Banque',
    
     ];
    //  use SoftDeletes;  // Activer les suppressions douces
    //  protected $dates = ['deleted_at'];  // Indiquer que 'deleted_at' est un champ de type date


    public function user()
{
    return $this->belongsTo(User::class, 'id_User');
}

public function banque()
{
    return $this->belongsTo(Banque::class, 'id_Banque');
}

public function transaction()
{
    return $this->hasMany(Transaction::class, 'id_Compte');
}

public function transfert()
{
    return $this->hasMany(Transfert::class, 'id_Compte');
}

public function rapprochement()
{
    return $this->hasMany(RapprochementBancaire::class, 'id_Compte');
}


}
