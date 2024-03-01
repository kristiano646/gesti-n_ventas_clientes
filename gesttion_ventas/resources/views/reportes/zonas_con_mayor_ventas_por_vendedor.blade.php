@extends('layouts.app')

@section('content')
    <h1>Listado de Zonas con Mayor Cantidad de Ventas por Vendedor</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID Vendedor</th>
                <th>Nombre Zona</th>
                <th>Cantidad de Ventas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($zonasVentas as $zonaVenta)
                <tr>
                    <td>{{ $zonaVenta->id_vendedor }}</td>
                    <td>{{ $zonaVenta->nombre_zona }}</td>
                    <td>{{ $zonaVenta->cantidad_ventas }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
