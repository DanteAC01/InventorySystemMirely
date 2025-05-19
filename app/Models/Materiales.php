<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materiales extends Model
{    
    use HasFactory;

    protected $fillable = [
        'nombre',
        'estado',
        'fecha_ingreso',
        'area_id',
    ];

    // app/models/materiales.php
    public function area()
    {
        return $this->belongsTo(Areas::class);
    }
}
