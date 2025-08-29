<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MessagesGroupes extends Model
{
    use HasFactory;

    protected $table = 'messages_groupes';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['groupes_id', 'emetteur_id', 'recepteur_id', 'contenu', 'date_envoi'];

    protected $casts = [
        'date_envoi' => 'datetime',
    ];

    /** Groupe concerné */
    public function groupe(): BelongsTo
    {
        return $this->belongsTo(Groupes::class, 'groupes_id');
    }

    /** Auteur du message */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'emetteur_id');
    }

    /** Récepteur si besoin */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recepteur_id');
    }
}
