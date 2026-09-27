<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    protected $guarded = ['id'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
