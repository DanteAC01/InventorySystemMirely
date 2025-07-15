<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MovementDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'movement_id',
        'material_id',
        'quantity',
        'status',
    ];

    public function movement()
    {
        return $this->belongsTo(Movement::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}