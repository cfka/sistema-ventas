<?php

namespace App\Models\Sistema\Compra;

use App\Models\Sistema\Producto\Producto;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
        protected $fillable = [
        'numero_compra',
        'fecha_compra',
        'producto_id',
        'cantidad',
        'cantidad_recibida',
        'fecha_estimada_llegada',
        'estado',
        'observaciones',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

}
