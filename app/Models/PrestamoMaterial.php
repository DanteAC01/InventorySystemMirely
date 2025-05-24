<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrestamoMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'prestamo_id',
        'material_id',
        'area_id',
        'cantidad',
        'estado'
    ];

    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}