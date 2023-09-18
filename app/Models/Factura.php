<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Factura extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'users_id',
        'concepto',
        'monto_deudor',
        'nombre_titular',
        'tipo_documento',
        'num_documento',
        'referencia_pago',
        'divisa',
        'metodo_pago',
        'plataforma_pago',
        'monto_pago',
        'status',
    ];
    protected $hidden = [

    ];
    protected $casts = [
        'fecha_pago' => 'datetime'
    ];
}
