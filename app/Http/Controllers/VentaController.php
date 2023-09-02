<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Venta;
use Illuminate\Support\Facades\Validator;

class VentaController extends Controller
{
    public function index()
    {
        $venta = Venta::all();

        return response()->json($venta);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fecha' => 'required|date',
            'cantidad' => 'required|integer',
            'precio_unitario' => 'required|numeric',
            'total' => 'required|numeric',
            'trabajador_id' => 'required|integer',
        ]);

        $validator = Validator::make($request->all(), [
            'fecha' => 'required|date',
            'cantidad' => 'required|integer',
            'precio_unitario' => 'required|numeric',
            'total' => 'required|numeric',
            'trabajador_id' => 'required|integer',
            'cliente_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $nuevaventa = new Venta();
        $nuevaventa->fecha = $request->fecha;
        $nuevaventa->cantidad = $request->cantidad;
        $nuevaventa->precio_unitario = $request->precio_unitario;
        $nuevaventa->total = $request->total;
        $nuevaventa->trabajador_id = $request->trabajador_id;
        $nuevaventa->cliente_id = $request->cliente_id;
        $nuevaventa->save();

        return response()->json($nuevaventa, 201);
    }

    public function update(Request $request, int $id)
    {
        $venta = Venta::find($id);

        if (!$venta) {
            return response()->json(['error' => 'Venta no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'fecha' => 'sometimes|date',
            'cantidad' => 'sometimes|integer',
            'precio_unitario' => 'sometimes|numeric',
            'total' => 'sometimes|numeric',
            'trabajador_id' => 'sometimes|integer',
            'cliente_id' => 'sometimes|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $venta->fecha = $request->fecha ?? $venta->fecha;
        $venta->cantidad = $request->cantidad ?? $venta->cantidad;
        $venta->precio_unitario = $request->precio_unitario ?? $venta->precio_unitario;
        $venta->total = $request->total ?? $venta->total;
        $venta->trabajador_id = $request->trabajador_id ?? $venta->trabajador_id;
        $venta->cliente_id = $request->cliente_id ?? $venta->cliente_id;
        $venta->save();

        return response()->json($venta, 200);
    }


    public function destroy(int $id)
    {
        $venta = Venta::find($id);

        if (!$venta) {
            return response()->json(['error' => 'Venta no encontrada'], 404);
        }

        $venta->status = 0;
        $venta->save();

        return response()->json(['success' => 'Venta eliminada'], 200);
    }
}
