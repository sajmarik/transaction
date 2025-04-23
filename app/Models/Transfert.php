<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfert extends Model
{
    use HasFactory;
protected  $guarded=[];

    public function compte()
{
    return $this->belongsTo(CompteBancaire::class, 'id_Compte');
}


}
