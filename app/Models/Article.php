<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Définition des champs pouvant être assignés en masse
    protected $fillable = ['titre', 'contenu', 'user_id'];

    /**
     * Relation avec l'utilisateur (auteur de l'article)
     * Un article appartient à un utilisateur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
