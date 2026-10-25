<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Proveedor extends Model
{
    use SoftDeletes;
    protected $table = 'proveedores';
    protected $guarded = ['id'];

    protected function nombre(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => Str::title(mb_strtolower($value))
        );
    }

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }

    public function empresas()
    {
        return $this->belongsToMany(Empresa::class, 'empresa_proveedor');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_proveedor');
    }
}
