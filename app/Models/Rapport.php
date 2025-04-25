<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rapport extends Model
{
    use HasFactory;


    protected $table = 'rapport'; // Spécifier le nom de la table
    protected $primaryKey = 'id_Rapport';      // Spécifier que la clé primaire 
  
  
    protected $fillable = [
      'Type_Rapport',
      'Date_generation',
      'id_Transaction',
      ];
  
       use SoftDeletes;  // Activer les suppressions douces
       protected $dates = ['deleted_at'];  // Indiquer que 'deleted_at' est un champ de type date
  
  




    public function transaction()
{
    return $this->hasMany(Transaction::class, 'id_Transaction');
}

}
