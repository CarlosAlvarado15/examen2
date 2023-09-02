<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DetalleVentaController extends Controller
{
    public function index()
    {
        $detallesVentas = DetalleVenta::all();

        return response()->json($detallesVentas);
    }


    public function show(int $id)
    {
        $detalleventa = DetalleVenta::find($id);

        if (!$detalleventa) {
            return response()->json(['error' => 'Detalle de venta no encontrado'], 404);
        }

        return response()->json($detalleventa);
    }
}
