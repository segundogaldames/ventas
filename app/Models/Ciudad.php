<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = 'ciudades';

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function empresas()
    {
        return $this->hasMany(Empresa::class);
    }
}
