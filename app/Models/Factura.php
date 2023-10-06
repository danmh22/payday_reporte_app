<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Factura extends Model
{
    use HasFactory;


    protected $fillable = [
        'aliados_id',
        'concepto',
        'monto_deudor',
        'status',
        'categoria',
    ];
    protected $hidden = [

    ];
    protected $casts = [
        'fecha_pago' => 'datetime'
    ];

    // Relación con aliados

    public function aliados(): BelongsTo
    {
        return $this->belongsTo(Aliado::class);
    }

    // Relación con pagos

    public function pagos() : HasMany
    {
        return $this->hasMany(Pago::class);
    }
}
