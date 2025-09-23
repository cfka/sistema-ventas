<?php

namespace App\Http\Controllers\Sistema\Producto;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sistema\Producto\CategoriaRequest;
use App\Models\Sistema\Producto\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        return view('sistema.producto.categoria.index');
    }


    public function create()
    {
        $categoria = new Categoria();
        return view('sistema.producto.categoria.create', compact('categoria'));
    }

    public function store(CategoriaRequest $request)
    {
        try {
            Categoria::create($request->validated());
            alert()->success('Éxito', 'Registro Guardado Exitosamente');
            return redirect()->route('categorias.index');
        } catch (\Exception $e) {
            alert()->error('Error', 'Transacci&oacute;n Fallida');
            return redirect()->back()->withInput();
        }
    }

    public function edit(Categoria $categoria)
    {
        return view('sistema.producto.categoria.edit', compact('categoria'));
    }

    public function update(CategoriaRequest $request, Categoria $categoria)
    {
        try {
            $categoria->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
            ]);
            alert()->success('Éxito', 'Registro Actualizado Exitosamente');
            return redirect()->route('categorias.index');
        } catch (\Exception $e) {
            alert()->error('Error', 'Transacci&oacute;n Fallida');
            return redirect()->back()->withInput();
        }
    }
}
