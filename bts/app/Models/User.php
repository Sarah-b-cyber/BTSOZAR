<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relations
     */
    public function student()
    {
        return $this->hasOne(Student::class, 'users_id');
    }

    public function prof()
    {
        return $this->hasOne(Prof::class, 'users_id');
    }

    /** Messages envoyés (privés) */
    public function sentMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'emetteur_id');
    }

    /** Messages reçus (privés) */
    public function receivedMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'recepteur_id');
    }

    /** Groupes dont l'utilisateur est membre */
    public function groupes(): BelongsToMany
    {
        // pivot non standard: "groupes_users"
        return $this->belongsToMany(Groupes::class, 'groupes_users', 'user_id', 'groupe_id');
    }

    /** Messages postés par l'utilisateur dans les groupes */
    public function groupMessages(): HasMany
    {
        return $this->hasMany(MessagesGroupes::class, 'emetteur_id');
    }

}
