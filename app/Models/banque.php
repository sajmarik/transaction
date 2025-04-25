<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banque extends Model
{
    use HasFactory;

       // Spécifier que la clé primaire est 'id_banque'
       protected $primaryKey = 'id_Banque';
       
    // Indiquer explicitement le nom de la tableprotected $table = 'banque';
    protected $table = 'banque';

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Nom_Banque',
        'Code_Bic',
        'Adresse_Siege',
    ];

   

    
     use SoftDeletes;  // Activer les suppressions douces

     protected $dates = ['deleted_at'];  // Indiquer que 'deleted_at' est un champ de type date

    /**
     * Relation avec les comptes bancaires.
     */
    public function compte_bancaire()
    {
        return $this->hasMany(compteBancaire::class, 'id_Banque');
    }
}
