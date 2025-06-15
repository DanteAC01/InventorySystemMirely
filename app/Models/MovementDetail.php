<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MovementDetail extends Model
{
    use HasFactory;

    public function movement()
    {
        return $this->belongsTo(Movements::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}