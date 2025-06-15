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
        //
        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['entrada', 'salida']);
            $table->foreignId('origin_sector_id')->nullable()->constrained('sectors');
            $table->foreignId('destination_sector_id')->nullable()->constrained('sectors');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamp('date')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
