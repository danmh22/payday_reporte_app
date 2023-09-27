<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
            $table->text('concepto');
            $table->float('monto_deudor', 8, 2);
            $table->timestamps();
            $table->enum('status', [1,2,3])->default(1);
            $table->string('nombre_titular')->nullable();
            $table->set('tipo_documento', ['V', 'J', 'P'])->nullable();
            $table->string('num_documento')->nullable();
            $table->string('referencia_pago')->nullable();
            $table->set('divisa', ['VES', 'USD'])->nullable();
            $table->set('metodo_pago', ['transferencia', 'pago móvil', 'depósito', 'efectivo'])->nullable();
            $table->string('plataforma_pago')->nullable();
            $table->float('monto_pago', 8, 2)->nullable();
            $table->date('fecha_pago')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
