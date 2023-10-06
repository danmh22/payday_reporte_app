<?php

namespace App\Models;

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
        'users_id',
    ];


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
