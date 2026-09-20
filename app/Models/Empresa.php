<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }

    public function empresaTipo()
    {
        return $this->belongsTo(EmpresaTipo::class);
    }

    public function impuestos()
    {
        return $this->hasMany(Impuesto::class);
    }

    public function monedas()
    {
        return $this->hasMany(Moneda::class);
    }

    public function telefonos()
    {
        return $this->hasMany(Telefono::class);
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'empresa_user');
    }
}
