<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Définition des champs pouvant être assignés en masse
    protected $fillable = ['contenu', 'user_id', 'forum_id'];

    /**
     * Relation avec le forum concerné.
     * Un commentaire appartient à un forum.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    /**
     * Relation avec l'utilisateur (auteur du commentaire).
     * Un commentaire est écrit par un utilisateur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
