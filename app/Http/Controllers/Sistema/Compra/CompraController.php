<?php

namespace App\Http\Controllers\Sistema\Compra;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sistema\Compras\CompraRequest;
use App\Models\Sistema\Compra\Compra;
use App\Models\Sistema\Producto\Categoria;
use App\Models\Sistema\Producto\Producto;
use App\Models\Sistema\Producto\Proveedor;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sistema.compra.compra.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $compra = new Compra();
        $productos = Producto::all();
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        $compra->numero_compra = Compra::max('numero_compra')+1;
        return view('sistema.compra.compra.create', compact('compra', 'productos', 'categorias', 'proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompraRequest $request)
    {
        try {
            foreach ($request->productoCompra as $producto) {
                if (!Producto::where('nombre', $producto['nombre_producto'])->first()) {
                    Producto::create([
                        'nombre' => $producto['nombre_producto'],
                        'descripcion' => '',
                        'imagen_dir' => '',
                        'categoria_id' => null,
                        'proveedor_id' => null,
                        'precio_proveedor' => $producto['precio_proveedor'],
                        'precio_envio' => $producto['precio_envio'],
                        'precio_costo' => $producto['precio_costo'],
                    ]);
                }else{
                    Producto::where('nombre', $producto['nombre_producto'])->update([
                        'precio_proveedor' => $producto['precio_proveedor'],
                        'precio_envio' => $producto['precio_envio'],
                        'precio_costo' => $producto['precio_costo'],
                    ]);
                }
                Compra::create([
                        'numero_compra' => $request->numero_compra,
                        'fecha_compra' => $request->fecha_compra,
                        'producto_id' => Producto::where('nombre', $producto['nombre_producto'])->first()->id,
                        'cantidad' => $producto['cantidad'],
                        'fecha_estimada_llegada' => $request->fecha_estimada_llegada,
                ]);
            }
            alert()->success('Éxito', 'Registro Guardado Exitosamente');
            return redirect()->route('compras.index');
        } catch (\Exception $e) {
            alert()->error('Error', 'Transacci&oacute;n Fallida');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($numero_compra, $fecha_compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($numero_compra, $fecha_compra)
    {
        $compra = Compra::where('numero_compra', $numero_compra)
        ->where('fecha_compra', $fecha_compra)
        ->with('producto') // carga relación producto
        ->get()
        ->map(function ($c) use ($numero_compra, $fecha_compra) {
            return (object) [
                'id' => $c->id,
                'numero_compra' => $numero_compra,
                'fecha_compra' => $fecha_compra,
                'producto_id' => $c->producto_id,
                'cantidad' => $c->cantidad,
                'fecha_estimada_llegada' => $c->fecha_estimada_llegada,
                'nombre_producto' => $c->producto->nombre,
                'precio_proveedor' => $c->producto->precio_proveedor,
                'precio_envio' => $c->producto->precio_envio,
                'precio_costo' => $c->producto->precio_costo,
            ];
        });
        $productos = Producto::all();
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        return view('sistema.compra.compra.edit', compact('compra', 'productos', 'categorias', 'proveedores'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompraRequest $request, $numero_compra, $fecha_compra)
    {
        try {
            // IDs de productoCompra que vienen en el request
            $idsRequest = collect($request->productoCompra)
            ->map(function($p){
                return Producto::where('nombre',$p['nombre_producto'])->value('id');
            })
            ->filter()
            ->toArray();
            
            // IDs de productoCompra que existen en DB
            $idsDB = Compra::where('numero_compra', $numero_compra)
                ->where('fecha_compra', $fecha_compra)
                ->pluck('producto_id')
                ->toArray();

            // Diferencia -> los que están en DB pero no vinieron en el request
            $idsEliminar = array_diff($idsDB, $idsRequest);

            if (!empty($idsEliminar)) {
                Compra::where('numero_compra', $numero_compra)
                    ->where('fecha_compra', $fecha_compra)
                    ->whereIn('producto_id', $idsEliminar)
                    ->delete();
            }

            foreach ($request->productoCompra as $producto) {
                
                if (!Producto::where('nombre', $producto['nombre_producto'])->first()) {
                    Producto::create([
                        'nombre' => $producto['nombre_producto'],
                        'descripcion' => '',
                        'imagen_dir' => '',
                        'categoria_id' => null,
                        'proveedor_id' => null,
                        'precio_proveedor' => $producto['precio_proveedor'],
                        'precio_envio' => $producto['precio_envio'],
                        'precio_costo' => $producto['precio_costo'],
                    ]);
                }else{
                    Producto::where('nombre', $producto['nombre_producto'])->update([
                        'precio_proveedor' => $producto['precio_proveedor'],
                        'precio_envio' => $producto['precio_envio'],
                        'precio_costo' => $producto['precio_costo'],
                    ]);
                }

                Compra::updateorCreate([
                        'numero_compra' => $numero_compra,
                        'producto_id' => Producto::where('nombre', $producto['nombre_producto'])->first()->id,
                        ],
                        [
                        'fecha_compra' => $request->fecha_compra,
                        'cantidad' => $producto['cantidad'],
                        'fecha_estimada_llegada' => $request->fecha_estimada_llegada,
                ]);
            }
            alert()->success('Éxito', 'Registro Guardado Exitosamente');
            return redirect()->route('compras.index');
        } catch (\Exception $e) {
            dd($e);
            alert()->error('Error', 'Transacci&oacute;n Fallida');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function estado($numero_compra, $fecha_compra)
    {
        try {

            $compras = Compra::where('numero_compra', $numero_compra)
            ->where('fecha_compra', $fecha_compra)
            ->get();

            // Verificar si existen compras
            if ($compras->isEmpty()) {
                alert()->warning('Atención', 'No se encontraron compras con esos datos');
                return redirect()->back()->withInput();
            }

            // Verificar si todas están en estado "Transito"
            $todasEnTransito = $compras->every(function ($compra) {
                return $compra->estado === 'Transito';
            });

            if ($todasEnTransito) {
                // Actualizar el estado
                Compra::where('numero_compra', $numero_compra)
                    ->where('fecha_compra', $fecha_compra)
                    ->update(['estado' => 'Recibido']);

                alert()->success('Éxito', 'Estado cambiado exitosamente');
            } else {
                alert()->error('Error', 'No se puede cambiar el estado de compras que no están en tránsito');
            }



            // Compra::where('numero_compra', $numero_compra)
            // ->where('fecha_compra', $fecha_compra)
            // ->update(['estado' => "Recibido"]);
            // alert()->success('Éxito', 'Estado Cambiado Exitosamente');


            return redirect()->route('compras.index');
        } catch (\Exception $e) {
            alert()->error('Error', 'Transacci&oacute;n Fallida');
            return redirect()->back()->withInput();
        }
    }
}
