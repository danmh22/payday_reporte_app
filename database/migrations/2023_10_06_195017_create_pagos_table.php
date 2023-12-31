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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_titular');
            $table->set('tipo_documento', ['V', 'J', 'P']);
            $table->string('num_documento');
            $table->string('referencia_pago');
            $table->set('divisa', ['VES', 'USD']);
            $table->set('metodo_pago', ['transferencia', 'pago móvil', 'depósito', 'efectivo']);
            $table->set('plataforma_pago', ['Banesco', 'Bancamiga', 'Mercantil Panamá', 'Zelle'])->nullable();
            $table->float('monto_pago', 8, 2);
            $table->float('monto_equivalente', 8, 2);
            $table->date('fecha_pago');
            $table->enum('status', [1,2,3])->default(1);
            $table->unsignedBigInteger('factura_id');
            $table->foreign('factura_id')->references('id')->on('factura');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
