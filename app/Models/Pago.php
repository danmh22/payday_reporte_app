<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_titular',
        'tipo_documento',
        'num_documento',
        'referencia_pago',
        'divisa',
        'metodo_pago',
        'plataforma_pago',
        'monto_pago',
        'monto_equivalente',
    ];


    // Relación con aliados y facturas

    public function aliado() : BelongsTo
    {
        return $this->belongsTo(Aliado::class);
    }

    public function facturas() : BelongsTo
    {
        return $this->belongsTo(Factura::class);
    }
}
