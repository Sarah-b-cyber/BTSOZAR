<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student'; // car pas "students"

    protected $fillable = [
        'phone',
        'classe_id',
        'adresse',
        'genre',
        'entreprise',
        'phone_entreprise',
        'mail_entreprise',
        'adresse_entreprise',
        'datebirth',
        'users_id',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }
}
