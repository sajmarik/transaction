<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorie extends Model
{
    use HasFactory;

       // Spécifier que la clé primaire est 'id_banque'
       protected $primaryKey = 'id_Cat';
       
    // Indiquer explicitement le nom de la table
    protected $table = 'categorie'; 
    protected $fillable = [
        'Nom_Cat',
        'Type_Cat',
       
    ];
    use SoftDeletes;  // Activer les suppressions douces
    protected $dates = ['deleted_at'];  // Indiquer que 'deleted_at' est un champ de type date

    public function transaction()
{
    return $this->hasMany(Transaction::class, 'id_Cat');
}


}
