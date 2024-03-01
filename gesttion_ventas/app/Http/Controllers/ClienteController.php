<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    // Mostrar todos los clientes
    public function index()
    {
    
        $clientes = Cliente::all();
        
        return view('clientes.index', compact('clientes'));
    }

    // Mostrar el formulario para crear un nuevo cliente
    public function create()
    {
        return view('clientes.create');
    }

    // Almacenar un nuevo cliente en la base de datos
    public function store(Request $request)
    {
        // Valida los datos del formulario según sea necesario
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            // Agrega validaciones para otros campos si es necesario
        ]);
    
        // Crea un nuevo cliente con los datos del formulario
        $cliente = new Cliente();
        $cliente->fill($request->all());
        $cliente->save();
    
        // Redirige al usuario a la vista de detalles del cliente recién creado
        return redirect()->route('clientes.index', $cliente->id)->with('success', 'Cliente creado correctamente.');
    }
    

    // Mostrar un cliente específico
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    // Mostrar el formulario para editar un cliente
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    // Actualizar un cliente específico en la base de datos
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->fill($request->all());
        $cliente->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    // Eliminar un cliente específico de la base de datos
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }
}
