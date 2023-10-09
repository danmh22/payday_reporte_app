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
            $table->float('monto_deudor', 8, 2);
            $table->enum('status', [1,2,3])->default(1);
            $table->enum('categoria', ['Mensualidad','Gastos Generales','Otros'])->default('Mensualidad');
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
