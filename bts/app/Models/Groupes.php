<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Groupes extends Model
{
    protected $table = 'groupes';

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false; // pas de created_at/updated_at

    protected $fillable = ['name'];

    /** Membres du groupe */
    public function users(): BelongsToMany
    {
        // pivot non standard "groupes_users"
        return $this->belongsToMany(User::class, 'groupes_users', 'groupe_id', 'user_id');
    }

    /** Messages du groupe */
    public function messages(): HasMany
    {
        return $this->hasMany(MessagesGroupes::class, 'groupes_id');
    }
    public function messages_groupes(): HasMany
    {
        return $this->hasMany(\App\Models\MessagesGroupes::class, 'groupes_id');
    }

}
