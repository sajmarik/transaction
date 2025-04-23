<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RapprochementBancaire extends Model
{
    use HasFactory;

    public function compte()
{
    return $this->belongsTo(CompteBancaire::class, 'id_Compte');
}

public function transaction()
{
    return $this->belongsTo(Transaction::class, 'id_Transaction');
}


}
