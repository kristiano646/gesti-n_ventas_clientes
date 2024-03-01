<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleVenta;

class DetalleVentaController extends Controller
{
    // Mostrar todos los detalles de venta
    public function index()
    {
        $detallesVenta = DetalleVenta::all();
        return view('detalles_venta.index', compact('detallesVenta'));
    }

    // Mostrar el formulario para crear un nuevo detalle de venta
    public function create()
    {
        return view('detalles_venta.create');
    }

    // Almacenar un nuevo detalle de venta en la base de datos
    public function store(Request $request)
    {
        $detalleVenta = new DetalleVenta();
        $detalleVenta->fill($request->all());
        $detalleVenta->save();

        return redirect()->route('detalles_venta.index')->with('success', 'Detalle de venta creado correctamente.');
    }

    // Mostrar un detalle de venta específico
    public function show($id)
    {
        $detalleVenta = DetalleVenta::findOrFail($id);
        return view('detalles_venta.show', compact('detalleVenta'));
    }

    // Mostrar el formulario para editar un detalle de venta
    public function edit($id)
    {
        $detalleVenta = DetalleVenta::findOrFail($id);
        return view('detalles_venta.edit', compact('detalleVenta'));
    }

    // Actualizar un detalle de venta específico en la base de datos
    public function update(Request $request, $id)
    {
        $detalleVenta = DetalleVenta::findOrFail($id);
        $detalleVenta->fill($request->all());
        $detalleVenta->save();

        return redirect()->route('detalles_venta.index')->with('success', 'Detalle de venta actualizado correctamente.');
    }

    // Eliminar un detalle de venta específico de la base de datos
    public function destroy($id)
    {
        $detalleVenta = DetalleVenta::findOrFail($id);
        $detalleVenta->delete();

        return redirect()->route('detalles_venta.index')->with('success', 'Detalle de venta eliminado correctamente.');
    }
}
