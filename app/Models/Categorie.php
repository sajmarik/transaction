<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    public function transaction()
{
    return $this->hasMany(Transaction::class, 'id_Categorie');
}


}
