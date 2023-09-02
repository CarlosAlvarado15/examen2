<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'fecha',
        'cantidad',
        'precio_unitario',
        'total',
        'trabajador_id',
        'cliente_id',
    ];

    public function trabajador()
    {
        return $this->belongsTo(Trabajadores::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Clientes::class);
    }
}
