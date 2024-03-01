@extends('layouts.app')

@section('content')
    <h1>Listado de Zonas sin Ventas en el Intervalo</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID Zona</th>
                <th>Nombre Zona</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($zonasSinVentas as $zona)
                <tr>
                    <td>{{ $zona->ID_ZONA }}</td>
                    <td>{{ $zona->nombre_zona }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
