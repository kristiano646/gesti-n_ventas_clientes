@extends('layouts.app')

@section('content')
    <h1>Listado de Vendedores sin Ventas en el Intervalo</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID Vendedor</th>
                <th>Nombre Vendedor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vendedoresSinVentas as $vendedor)
                <tr>
                    <td>{{ $vendedor->ID_VENDEDOR }}</td>
                    <td>{{ $vendedor->nombre }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
