<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prestamo_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prestamo_id')->constrained('prestamos')->onDelete('cascade');
            $table->foreignId('material_id')->constrained('materials');
            $table->foreignId('area_id')->constrained('areas');
            $table->integer('cantidad');
            $table->enum('estado', ['prestado', 'devuelto', 'pendiente','perdida'])->default('prestado');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestamo_materiales');
    }
};
