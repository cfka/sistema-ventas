<?php

namespace App\Models\Sistema\Producto;

use App\Models\Sistema\Compra\Compra;
use App\Models\Sistema\Inventario\Inventario;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
        'categoria_id',
        'proveedor_id',
        'precio_proveedor',
        'precio_envio',
        'precio_costo',
        'imagen_dir'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
    
    public function inventario(){
        return $this->hasMany(Inventario::class); 
    }

        public function compra(){
        return $this->hasMany(Compra::class); 
    }


}
