<?php

namespace App\Models\Sistema\Producto;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
