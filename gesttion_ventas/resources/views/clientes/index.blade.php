@extends('layouts.app')
@section('content')
<h1>Listado de Clientes</h1>
<a href="{{ route('clientes.create') }}" class="btn btn-primary">Crear Cliente</a>
<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @if (!empty($clientes))
        @foreach ($clientes as $cliente)
        <tr>
            <td>{{ $cliente->nombre }}</td>
            <td>{{ $cliente->email }}</td>
            <td>
            <a href="{{ route('clientes.show', $cliente->id ?? '') }}" class="btn btn-info">Ver</a>
                <a href="{{ route('clientes.edit', $cliente->id ?? '') }}" class="btn btn-primary">Editar</a>
                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
        @else
        <p>No hay clientes disponibles.</p>
        @endif
    </tbody>
</table>
@endsection