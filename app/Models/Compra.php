<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Compra extends Model
{
    protected $guarded = ['id'];

    protected function nombre(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => Str::title(mb_strtolower($value))
        );
    }

    public function calcularTotal()
    {
        // Suma el (cantidad * precio_unitario) de todos los detalles asociados
        $nuevoTotal = $this->compraDetalles()->sum(DB::raw('cantidad * precio_unitario'));

        // Actualizamos el campo total de la compra
        $this->update(['total' => $nuevoTotal]);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function compraDetalles()
    {
        return $this->hasMany(CompraDetalle::class);
    }
}
