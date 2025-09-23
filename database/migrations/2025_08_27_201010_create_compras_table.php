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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();

            $table->integer('numero_compra');            // ej: CMP-2025-0001

            $table->date('fecha_compra')->nullable();

            $table->foreignId('producto_id')->nullable()->constrained('productos')->onDelete('set null');

            $table->integer('cantidad')->nullable()->default(0);                // cantidad comprada
            $table->integer('cantidad_recibida')->nullable()->default(0); // recepciones parciales

            $table->date('fecha_estimada_llegada')->nullable();

            // Estado por renglón (producto) de esta compra:
            // registrada | en_transito | recibida | cancelada
            $table->string('estado', 20)->default('Transito')->nullable();

            $table->text('observaciones')->nullable();
            $table->timestamps();

            // Evita el mismo producto repetido dentro del mismo numero_compra
            $table->unique(['numero_compra', 'producto_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
