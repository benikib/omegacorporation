<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        "cote"
    ];
    public function etudiant(){
        return $this->belongsTo(Utilisateur::class);
    }
    public function cour(){
        return $this->belongsTo(Formation::class);
    }
}
