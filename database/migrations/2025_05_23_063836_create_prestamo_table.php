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
        // database/migrations/xxxx_xx_xx_create_loans_table.php
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // A quien se le presta
            $table->foreignId('alumno_id')->constrained('alumnos'); // A quien se le presta
            $table->foreignId('material_id')->constrained('materials'); // Material prestado
            $table->foreignId('area_id')->constrained('areas')->after('material_id');
            $table->date('fecha_prestamo'); // Fecha del préstamo
            $table->date('fecha_devolucion')->nullable(); // Antes era requerido
            $table->integer('cantidad'); // Cantidad prestada
            $table->enum('estado', ['prestado', 'devuelto', 'pendiente','perdida'])->default('prestado'); // Estado del préstamo
            $table->text('observaciones')->nullable(); // Observaciones
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamo');
    }
};
