<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;
    protected $fillable = [
        'intitule',
        'ponderation',
        'professeur_id'
    ];

        public function professeur() {
            return $this->belongsTo(Professeur::class);
         }
         public function notes(){
            return $this->hasOne(Note::class);
        }
}
