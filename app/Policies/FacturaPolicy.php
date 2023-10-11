<?php

namespace App\Policies;

use App\Models\Aliado;
use App\Models\Factura;
use App\Models\User;

class FacturaPolicy
{
    public function invoiceOwner(User $user, Factura $factura){
        if (($user->hasRole('Admin')) or ($user->aliados->id == $factura->aliado_id)) {
            return true;
        } else {
            return false;   
        }
    }
}
