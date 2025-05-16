<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Areas extends Model
{
    use HasFactory;

    protected $fillable = [
        'Nombre',
        'Descripcion',
    ];

    //app/models/Area.php
    public function materiales()
    {
     return $this ->hasmany(materiales::class);
    }
}
