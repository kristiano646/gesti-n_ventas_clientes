@extends('layouts.app')

@section('content')
    <h1>Ventas por Cliente</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID Cliente</th>
                <th>Nombre Cliente</th>
                <th>Zona</th>
                <th>Ventas 2020</th>
                <th>Ventas 2021</th>
                <th>Ventas 2022</th>
                <th>Ventas 2023</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventasPorCliente as $venta)
                <tr>
                    <td>{{ $venta->ID_CLIENTE }}</td>
                    <td>{{ $venta->nombre_cliente }}</td>
                    <td>{{ $venta->zona }}</td>
                    <td>{{ $venta->ventas_2020 }}</td>
                    <td>{{ $venta->ventas_2021 }}</td>
                    <td>{{ $venta->ventas_2022 }}</td>
                    <td>{{ $venta->ventas_2023 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
