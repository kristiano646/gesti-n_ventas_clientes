<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    // Mostrar todas las ventas
    public function index()
    {
        $ventas = Venta::all();
        return view('ventas.index', compact('ventas'));
    }

    // Mostrar el formulario para crear una nueva venta
    public function create()
    {
        return view('ventas.create');
    }

    // Almacenar una nueva venta en la base de datos
    public function store(Request $request)
    {
        $venta = new Venta();
        $venta->fill($request->all());
        $venta->save();

        return redirect()->route('ventas.index')->with('success', 'Venta creada correctamente.');
    }

    // Mostrar una venta específica
    public function show($id)
    {
        $venta = Venta::findOrFail($id);
        return view('ventas.show', compact('venta'));
    }

    // Mostrar el formulario para editar una venta
    public function edit($id)
    {
        $venta = Venta::findOrFail($id);
        return view('ventas.edit', compact('venta'));
    }

    // Actualizar una venta específica en la base de datos
    public function update(Request $request, $id)
    {
        $venta = Venta::findOrFail($id);
        $venta->fill($request->all());
        $venta->save();

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente.');
    }

    // Eliminar una venta específica de la base de datos
    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente.');
    }
    public function vendedoresSinVentasEnIntervalo(Request $request)
    {
        // Obtener las fechas del intervalo desde el request
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        // Consulta para obtener los vendedores sin ventas en el intervalo de fechas
        $vendedoresSinVentas = DB::table('Vendedores')
            ->leftJoin('Ventas', function($join) use ($fechaInicio, $fechaFin) {
                $join->on('Vendedores.ID_VENDEDOR', '=', 'Ventas.id_vendedor')
                    ->whereBetween('Ventas.fecha', [$fechaInicio, $fechaFin]);
            })
            ->select('Vendedores.ID_VENDEDOR', 'Vendedores.nombre')
            ->whereNull('Ventas.id_venta')
            ->groupBy('Vendedores.ID_VENDEDOR', 'Vendedores.nombre')
            ->get();

        return view('reportes.vendedores_sin_ventas_en_intervalo', ['vendedoresSinVentas' => $vendedoresSinVentas]);
    }

    public function ventasPorCliente()
    {
        $ventasPorCliente = DB::table('Clientes')
            ->leftJoin('Ventas', 'Clientes.ID_CLIENTE', '=', 'Ventas.id_cliente')
            ->leftJoin('Zonas', 'Ventas.id_zona', '=', 'Zonas.ID_ZONA')
            ->select(
                'Clientes.ID_CLIENTE',
                'Clientes.nombre AS nombre_cliente',
                'Zonas.nombre_zona AS zona',
                DB::raw('SUM(CASE WHEN YEAR(Ventas.fecha) = 2020 THEN Ventas.monto_total ELSE 0 END) AS ventas_2020'),
                DB::raw('SUM(CASE WHEN YEAR(Ventas.fecha) = 2021 THEN Ventas.monto_total ELSE 0 END) AS ventas_2021'),
                DB::raw('SUM(CASE WHEN YEAR(Ventas.fecha) = 2022 THEN Ventas.monto_total ELSE 0 END) AS ventas_2022'),
                DB::raw('SUM(CASE WHEN YEAR(Ventas.fecha) = 2023 THEN Ventas.monto_total ELSE 0 END) AS ventas_2023')
            )
            ->groupBy('Clientes.ID_CLIENTE', 'Clientes.nombre', 'Zonas.nombre_zona')
            ->get();

        return view('reportes.ventas_por_cliente', ['ventasPorCliente' => $ventasPorCliente]);
    }
}
