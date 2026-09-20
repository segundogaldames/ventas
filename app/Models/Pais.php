<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Pais extends Model
{
    protected $table = 'paises';

    protected $guarded = ['id'];

    protected function nombre(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => Str::title(mb_strtolower($value))
        );
    }

    public function provincias()
    {
        return $this->hasMany(Provincia::class);
    }
}
