<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function cours()
    {
        return $this->hasMany(Cours::class);
    }
    public function users()
    {
        return $this->hasOne(User::class);
    }

}
