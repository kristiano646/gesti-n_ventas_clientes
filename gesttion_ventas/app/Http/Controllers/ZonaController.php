<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zona;
use Illuminate\Support\Facades\DB;

class ZonaController extends Controller
{
    // Mostrar todas las zonas
    public function index()
    {
        $zonas = Zona::all();
        return view('zonas.index', compact('zonas'));
    }

    // Mostrar el formulario para crear una nueva zona
    public function create()
    {
        return view('zonas.create');
    }

    // Almacenar una nueva zona en la base de datos
    public function store(Request $request)
    {
        $zona = new Zona();
        $zona->fill($request->all());
        $zona->save();

        return redirect()->route('zonas.index')->with('success', 'Zona creada correctamente.');
    }

    // Mostrar una zona específica
    public function show($id)
    {
        $zona = Zona::findOrFail($id);
        return view('zonas.show', compact('zona'));
    }

    // Mostrar el formulario para editar una zona
    public function edit($id)
    {
        $zona = Zona::findOrFail($id);
        return view('zonas.edit', compact('zona'));
    }

    // Actualizar una zona específica en la base de datos
    public function update(Request $request, $id)
    {
        $zona = Zona::findOrFail($id);
        $zona->fill($request->all());
        $zona->save();

        return redirect()->route('zonas.index')->with('success', 'Zona actualizada correctamente.');
    }

    // Eliminar una zona específica de la base de datos
    public function destroy($id)
    {
        $zona = Zona::findOrFail($id);
        $zona->delete();

        return redirect()->route('zonas.index')->with('success', 'Zona eliminada correctamente.');
    }
    public function zonasConMayorCantidadVentasPorVendedor()
    {
        $zonasVentas = DB::table('Ventas')
            ->select('Ventas.id_vendedor', 'Zonas.nombre_zona', DB::raw('COUNT(Ventas.id_venta) as cantidad_ventas'))
            ->join('Zonas', 'Ventas.id_zona', '=', 'Zonas.ID_ZONA')
            ->groupBy('Ventas.id_vendedor', 'Zonas.nombre_zona')
            ->orderBy('Ventas.id_vendedor')
            ->orderByDesc('cantidad_ventas')
            ->get();

        return view('reportes.zonas_con_mayor_ventas_por_vendedor', ['zonasVentas' => $zonasVentas]);
    }
    public function zonasSinVentasEnIntervalo(Request $request)
    {
        // Obtenemos las fechas del intervalo desde el request
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        // Consulta para obtener las zonas sin ventas en el intervalo de fechas
        $zonasSinVentas = DB::table('Zonas')
            ->leftJoin('Ventas', function($join) use ($fechaInicio, $fechaFin) {
                $join->on('Zonas.ID_ZONA', '=', 'Ventas.id_zona')
                    ->whereBetween('Ventas.fecha', [$fechaInicio, $fechaFin]);
            })
            ->select('Zonas.ID_ZONA', 'Zonas.nombre_zona')
            ->whereNull('Ventas.id_venta')
            ->get();

        return view('reportes.zonas_sin_ventas_en_intervalo', ['zonasSinVentas' => $zonasSinVentas]);
    }

}
