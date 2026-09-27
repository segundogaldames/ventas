<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Ciudad extends Model
{
    protected $table = 'ciudades';
    protected $guarded = ['id'];

    protected function nombre(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => Str::title(mb_strtolower($value))
        );
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function empresas()
    {
        return $this->hasMany(Empresa::class);
    }
}
