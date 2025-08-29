<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    protected $table = 'matiere';

    protected $fillable = [
        'name',
        'avis',
        'coef',
    ];

    // Relations
    public function profs()
    {
        return $this->hasMany(Prof::class, 'matiere_id');
    }
}
