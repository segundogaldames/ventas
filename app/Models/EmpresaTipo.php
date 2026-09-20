<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpresaTipo extends Model
{
    public function empresa()
    {
        return $this->hasMany(Empresa::class);
    }
}
