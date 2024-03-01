<?php


Route::get('/', function () {
    return view('clientes.index');
});



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ZonaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DetalleVentaController;

Route::group(['prefix' => 'admin'], function () {
    // Rutas para Cliente
    Route::resource('clientes', ClienteController::class);

    // Rutas para Zona
    Route::resource('zonas', ZonaController::class);

    // Rutas para Producto
    Route::resource('productos', ProductoController::class);

    // Rutas para Venta
    Route::resource('ventas', VentaController::class);

    // Rutas para DetalleVenta
    Route::resource('detalles-ventas', DetalleVentaController::class);
    //reportes
    Route::get('/reportes/zonas-con-mayor-ventas', [ZonaController::class, 'zonasConMayorCantidadVentasPorVendedor'])->name('reportes.zonas_con_mayor_ventas');
    Route::get('/reportes/zonas-sin-ventas', [ZonaController::class, 'zonasSinVentasEnIntervalo'])->name('reportes.zonas_sin_ventas');
    Route::get('/reportes/vendedores-sin-ventas', [VentaController::class, 'vendedoresSinVentasEnIntervalo'])->name('reportes.vendedores_sin_ventas');
    Route::get('/reportes/ventas-por-cliente', [VentaController::class, 'ventasPorCliente'])->name('reportes.ventas_por_cliente');

});
