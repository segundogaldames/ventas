<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Provincia extends Model
{
    protected $guarded = ['id'];

    protected function nombre(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => Str::title(mb_strtolower($value))
        );
    }
    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function ciudades()
    {
        return $this->hasMany(Ciudad::class);
    }
}
