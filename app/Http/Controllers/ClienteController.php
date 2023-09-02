<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();

        return response()->json($clientes);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255',
            'telefono' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $nuevocliente = new Cliente();
        $nuevocliente->nombre = $request->nombre;
        $nuevocliente->apellido = $request->apellido;
        $nuevocliente->correo = $request->correo;
        $nuevocliente->telefono = $request->telefono;
        $nuevocliente->save();

        return response()->json($nuevocliente, 201); // Devuelve el cliente creado con código de respuesta 201 (Created)
    }


    public function update(Request $request, int $id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|string|max:255',
            'apellido' => 'sometimes|string|max:255',
            'correo' => 'sometimes|string|email|max:255',
            'telefono' => 'sometimes|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $cliente->nombre = $request->nombre ?? $cliente->nombre;
        $cliente->apellido = $request->apellido ?? $cliente->apellido;
        $cliente->correo = $request->correo ?? $cliente->correo;
        $cliente->telefono = $request->telefono ?? $cliente->telefono;
        $cliente->save();

        return response()->json($cliente, 200);
    }

    public function destroy(int $id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        $cliente->status = 0;
        $cliente->save();

        return response()->json(['success' => 'Cliente eliminado'], 200);
    }
}
