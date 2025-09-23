<?php

use App\Http\Controllers\Sistema\Compra\CompraController;
use App\Http\Controllers\Sistema\Inventario\InventarioController;
use App\Http\Controllers\Sistema\Producto\CategoriaController;
use App\Http\Controllers\Sistema\Producto\ProductoController;
use App\Http\Controllers\Sistema\Producto\ProveedorController;
use App\Http\Controllers\Sistema\Usuario\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Solo una vez esta ruta:
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])
    ->group(function () {
        /*---------------------------------------------------------------------------*/
        /*               Rutas de Categorias                						 */
        /*---------------------------------------------------------------------------*/
        Route::prefix('categorias')
            ->name('categorias.')
            ->controller(CategoriaController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create/', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                // Route::get('pdf', 'imprimir_pdf')->name('imprimir_pdf');
                Route::get('edit/{categoria}', 'edit')->name('edit');
                Route::get('show/{categoria}', 'show')->name('show');
                Route::put('{categoria}', 'update')->name('update');
        });
        /*---------------------------------------------------------------------------*/
        /*               Rutas de Proveedores             							 */
        /*---------------------------------------------------------------------------*/
        Route::prefix('proveedores')
            ->name('proveedores.')
            ->controller(ProveedorController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create/', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                // Route::get('pdf', 'imprimir_pdf')->name('imprimir_pdf');
                Route::get('edit/{proveedor}', 'edit')->name('edit');
                Route::get('show/{proveedor}', 'show')->name('show');
                Route::put('{proveedor}', 'update')->name('update');
        });
        /*---------------------------------------------------------------------------*/
        /*               Rutas de Productos                 						 */
        /*---------------------------------------------------------------------------*/
        Route::prefix('productos')
            ->name('productos.')
            ->controller(ProductoController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create/', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                // Route::get('pdf', 'imprimir_pdf')->name('imprimir_pdf');
                Route::get('edit/{producto}', 'edit')->name('edit');
                Route::get('show/{producto}', 'show')->name('show');
                Route::put('{producto}', 'update')->name('update');
        });
        /*---------------------------------------------------------------------------*/
        /*               Rutas de Usuarios                  						 */
        /*---------------------------------------------------------------------------*/
        Route::prefix('usuarios')
            ->name('usuarios.')
            ->controller(UsuarioController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create/', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                // Route::get('pdf', 'imprimir_pdf')->name('imprimir_pdf');
                Route::get('edit/{usuario}', 'edit')->name('edit');
                Route::get('show/{usuario}', 'show')->name('show');
                Route::put('{usuario}', 'update')->name('update');
        });
        /*---------------------------------------------------------------------------*/
        /*               Rutas de Inventarios                  						 */
        /*               Uso usuario para saber de quien es el inventario   		 */
        /*---------------------------------------------------------------------------*/
        Route::prefix('inventarios')
            ->name('inventarios.')
            ->controller(InventarioController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create/', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                // Route::get('pdf', 'imprimir_pdf')->name('imprimir_pdf');
                Route::get('edit/{usuario}', 'edit')->name('edit');
                Route::get('show/{usuario}', 'show')->name('show');
                Route::put('{usuario}', 'update')->name('update');
        });
        /*---------------------------------------------------------------------------*/
        /*               Rutas de Compras                  						 */
        /*---------------------------------------------------------------------------*/
        Route::prefix('compras')
            ->name('compras.')
            ->controller(CompraController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create/', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                // Route::get('pdf', 'imprimir_pdf')->name('imprimir_pdf');
                Route::get('edit/{numero_compra}/{fecha_compra}', 'edit')->name('edit');
                Route::get('show/{numero_compra}/{fecha_compra}', 'show')->name('show');
                Route::get('estado/{numero_compra}/{fecha_compra}', 'estado')->name('estado');
                Route::put('{numero_compra}/{fecha_compra}', 'update')->name('update');
        });
    });