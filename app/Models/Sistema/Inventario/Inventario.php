<?php

namespace App\Models\Sistema\Inventario;

use App\Models\Sistema\Producto\Producto;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $fillable = [
        'producto_id',
        'usuario_id',
        'stock',
        'precio_vendedor', 
        'precio_venta', 
        'estado'
    ];

    public function producto() { 
        return $this->belongsTo(Producto::class); 
    }
    public function usuario()  { 
        return $this->belongsTo(User::class, 'usuario_id'); 
    }

    /* Helpers */
    public function esEnTransito(): bool { return is_null($this->usuario_id); }
}
