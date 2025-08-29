<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    /** Table non standard (pas de "messages" auto?) -> on précise quand même explicitement */
    protected $table = 'messages';

    /** PK auto-incrément entière non signée */
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    /** Pas de created_at/updated_at dans le schéma */
    public $timestamps = false;

    /** Colonnes autorisées en écriture */
    protected $fillable = ['emetteur_id', 'recepteur_id', 'contenu', 'date_envoi'];

    /** Casts (timestamp → datetime Carbon) */
    protected $casts = [
        'date_envoi' => 'datetime',
    ];

    /** L’émetteur (sender) */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'emetteur_id');
    }

    /** Le récepteur (receiver) */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recepteur_id');
    }


    /** Scope: fil privé entre 2 users (trié chronologiquement) */
    public function scopeBetween(Builder $q, int $userA, int $userB): Builder
    {
        return $q->where(function ($t) use ($userA, $userB) {
            $t->where('emetteur_id', $userA)->where('recepteur_id', $userB);
        })->orWhere(function ($t) use ($userA, $userB) {
            $t->where('emetteur_id', $userB)->where('recepteur_id', $userA);
        })
            ->orderBy('date_envoi');
    }
}
