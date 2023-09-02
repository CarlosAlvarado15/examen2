<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();

        return response()->json($productos);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'codigo' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $nuevoproducto = new Producto();
        $nuevoproducto->codigo = $request->codigo;
        $nuevoproducto->descripcion = $request->descripcion;
        $nuevoproducto->precio = $request->precio;
        $nuevoproducto->stock = $request->stock;
        $nuevoproducto->save();

        return response()->json($nuevoproducto, 201); // Devuelve el producto creado con código de respuesta 201 (Created)
    }
    public function update(Request $request, int $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'codigo' => 'sometimes|string|max:255',
            'descripcion' => 'sometimes|string|max:255',
            'precio' => 'sometimes|numeric',
            'stock' => 'sometimes|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $producto->codigo = $request->codigo ?? $producto->codigo;
        $producto->descripcion = $request->descripcion ?? $producto->descripcion;
        $producto->precio = $request->precio ?? $producto->precio;
        $producto->stock = $request->stock ?? $producto->stock;
        $producto->save();

        return response()->json($producto, 200);
    }

    public function destroy(int $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $producto->status = 0;
        $producto->save();
        return response()->json(['success' => 'Producto eliminado'], 200);
    }
}
