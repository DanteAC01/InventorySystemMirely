<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{    
    use HasFactory;
    
    protected $fillable = [
        'nombre',
        'descripcion',
        'total',
        'cantidad_disponible',
        'estado',
        'fecha_ingreso',
        'area_id',
    ];

    // app/models/materiales.php
    public function area()
    {
        return $this->belongsTo(Areas::class, 'area_id');
    }
    
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }
}
