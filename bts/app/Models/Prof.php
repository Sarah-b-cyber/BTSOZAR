<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prof extends Model
{
    protected $table = 'prof';

    protected $fillable = [
        'matiere_id',
        'phone',
        'classe_id',
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

    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'matiere_id');
    }
}
