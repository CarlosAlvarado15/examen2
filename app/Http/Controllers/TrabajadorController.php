<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrabajadorController extends Controller
{
    public function index()
    {
        $trabajadores = Trabajador::all();

        return response()->json($trabajadores);
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

        $nuevostrabajador = new Trabajador();
        $nuevostrabajador->nombre = $request->nombre;
        $nuevostrabajador->apellido = $request->apellido;
        $nuevostrabajador->correo = $request->correo;
        $nuevostrabajador->telefono = $request->telefono;
        $nuevostrabajador->save();

        return response()->json($nuevostrabajador, 201); // Devuelve el trabajador creado con código de respuesta 201 (Created)
    }

    public function update(Request $request)
    {
        $trabajador = Trabajador::find($request->id);

        if (!$trabajador) {
            return response()->json(['error' => 'Trabajador no encontrado'], 404);
        }

        $trabajador->nombre = $request->nombre;
        $trabajador->apellido = $request->apellido;
        $trabajador->correo = $request->correo;
        $trabajador->telefono = $request->telefono;
        $trabajador->save();

        return response()->json($trabajador, 200);
    }
    public function destroy(Request $request)
    {
        $trabajador = Trabajador::find($request->id);
        $trabajador->status = 0;
        $trabajador->save();
    }
}
