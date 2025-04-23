<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompteBancaire extends Model
{
    use HasFactory;
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
