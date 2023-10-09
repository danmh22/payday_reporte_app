<?php

namespace App\Models;
use App\Models\User;
use App\Models\Factura;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aliado extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_aliado',
        'nombre_aliado',
        'status',
        'user_id',
    ];


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relación con facturas

    public function facturas() : HasMany
    {
        return $this->hasMany(Factura::class);
    }
}
