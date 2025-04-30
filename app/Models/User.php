<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', 
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    use SoftDeletes;  // Activer les suppressions douces

    protected $dates = ['deleted_at'];  // Indiquer que 'deleted_at' est un champ de type date



       // Méthode pour vzrifier si l utilisateur est admin
       public function isAdmin()
       {
           return $this->role === 'admin';
       }

    public function compte_bancaire()
{
    return $this->hasMany(compte_bancaire::class, 'id_User');
}

public function transaction()
{
    return $this->hasMany(Transaction::class, 'id_User');
}
}
