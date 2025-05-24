<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'alumno_id',
        'material_id',
        'area_id',
        'fecha_prestamo',
        'fecha_devolucion',
        'cantidad',
        'estado',
        'observaciones',
    ];

    // app/Models/Prestamo.php
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    public function area() {
        return $this->belongsTo(Areas::class, 'area_id');
    }
}
