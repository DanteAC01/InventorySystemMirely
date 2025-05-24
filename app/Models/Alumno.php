<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = [
        'Nombre',
        'Programa_estudios',
        'dni',
    ];

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }
}
