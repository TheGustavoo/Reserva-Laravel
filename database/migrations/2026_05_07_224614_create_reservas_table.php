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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            // Liga com a tabela salas
            $table->foreignId('sala_id')->constrained('salas')->onDelete('cascade');
            // Liga com a tabela de professores
            $table->foreignId('professor_id')->constrained('professores')->onDelete('cascade');
            $table->date('data_reserva');
            $table->time('hora_inicio');
            $table->time('hora_fim');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
