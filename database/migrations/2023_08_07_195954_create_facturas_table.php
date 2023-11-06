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
            $table->unsignedBigInteger('aliado_id');
            $table->foreign('aliado_id')->references('id')->on('aliado');
            $table->text('concepto');
            $table->float('monto_dolar', 8, 2);
            $table->float('monto_original_bs', 8, 2);
            $table->float('monto_actual_bs', 8, 2)->nullable();
            $table->float('dif_cambiario', 8, 2)->nullable();
            $table->enum('status', [1,2,3])->default(1);
            $table->enum('categoria', ['Alquiler','Parking','Gastos Comunes','Gastos No Comunes','Reembolsables','Condominios'])->default('Alquiler');
            $table->boolean('con_retraso')->default(0);
            $table->timestamps();
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
