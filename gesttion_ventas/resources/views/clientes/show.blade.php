@extends('layouts.app')

@section('content')
    <h1>Detalles del Cliente</h1>
    <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
    <p><strong>Email:</strong> {{ $cliente->email }}</p>
    <!-- Agrega más detalles según necesites -->
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver</a>
@endsection
