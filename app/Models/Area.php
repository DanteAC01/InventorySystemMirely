<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    //app/models/Area.php
    public function materiales()
    {
     return $this ->hasmany(material::class, 'area_id');
    }

    public function loans() {
    return $this->hasMany(Prestamos::class);
}

}
