<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Echeance extends Model
{
    use HasFactory;

    
       // Spécifier que la clé primaire est 'id_banque'
       protected $primaryKey = 'id_Echeance';
       
    // Indiquer explicitement le nom de la table
    protected $table = 'echeance'; 
    protected $fillable = [
        'Date_Echeance',  
        'Statut',
        'Type_Echeance',
    ];

    use SoftDeletes; 
    protected $dates = ['Date_Echeance', 'deleted_at'];  




    public function transaction()
{
    return $this->hasOne(Transaction::class, 'id_Transaction');
}


}
