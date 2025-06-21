<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    // Définition des attributs pouvant être assignés en masse
    protected $fillable = ['titre', 'fichier', 'user_id', 'forum_id'];

    /**
     * Relation avec l'utilisateur ayant téléchargé le document.
     * Un document appartient à un utilisateur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation optionnelle avec un forum.
     * Un document peut être associé à un post de forum.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }
}
