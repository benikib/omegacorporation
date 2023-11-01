<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'post_nom',
        'prenom',
        'adresse',
        'telephone',
        'email',
        'password',
    ];

}
