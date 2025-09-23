<?php

namespace App\Models\Sistema\Producto;


use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{

    protected $table = 'proveedores';

    protected $fillable = [
        'nombre', 
        'email', 
        'telefono', 
        'direccion'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
