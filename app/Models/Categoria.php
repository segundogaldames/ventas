<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Categoria extends Model
{
    protected $guarded = ['id'];

    protected function nombre(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => Str::title(mb_strtolower($value))
        );
    }

    protected function descripcion(): Attribute
    {
        return Attribute::make(
            set: fn($value) => ucfirst($value)
            // O usa solo ucfirst($value) si quieres respetar las mayúsculas internas que el usuario escriba
        );
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
