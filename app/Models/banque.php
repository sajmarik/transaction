<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Banque extends Model
{
    public function compteBancaire()
    {
        return $this->hasMany(CompteBancaire::class, 'id_Banque');
    }
    }
