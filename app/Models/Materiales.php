<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materiales extends Model
{
    // app/models/materiales.php
    public function area()
    {
        return $this->belongsTo(Areas::class);
    }
}
