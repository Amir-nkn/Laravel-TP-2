<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    // Définition des champs pouvant être assignés en masse
    protected $fillable = ['titre', 'contenu', 'user_id'];

    /**
     * Relation avec l'utilisateur ayant créé le post du forum.
     * Un post appartient à un utilisateur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec les commentaires associés à ce post.
     * Un post peut avoir plusieurs commentaires.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
