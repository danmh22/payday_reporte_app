<?php

namespace App\Models;
use App\Models\Aliado;
use App\Models\Pago;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Factura extends Model
{
    use HasFactory;


    protected $fillable = [
        'aliado_id',
        'concepto',
        'monto_deudor',
        'status',
        'categoria',
    ];
    protected $hidden = [

    ];

    // Relación con aliados

    public function aliado(): BelongsTo
    {
        return $this->belongsTo(Aliado::class);
    }

    // Relación con pagos

    public function pagos() : HasMany
    {
        return $this->hasMany(Pago::class);
    }
}
