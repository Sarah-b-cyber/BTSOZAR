<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $table = 'classe';

    protected $fillable = [
        'name',
        'description',
    ];

    // Relations
    public function students()
    {
        return $this->hasMany(Student::class, 'classe_id');
    }

    public function profs()
    {
        return $this->hasMany(Prof::class, 'classe_id');
    }
}
