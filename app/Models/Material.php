<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{    
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'quantityAvailable',
        'status',
        'sector_id',
        'dateEntry'
    ];

    // app/models/materiales.php
    public function sector()
    {
        return $this->belongsTo(Sector::class,);
    }

    public function movementDetails()
    {
        return $this->hasMany(MovementDetail::class);
    }
}
