<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    // Définir les champs qui peuvent être assignés en masse
    protected $fillable = [
        'nom',
        'adresse',
        'telephone',
        'email',
        'date_naissance',
        'ville_id',
        'user_id',
    ];

    // Définir la relation entre un étudiant et une ville (plusieurs étudiants appartiennent à une ville)
    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }
}
