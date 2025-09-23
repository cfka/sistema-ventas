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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->string('imagen_dir')->nullable();

            $table->foreignId('categoria_id')->nullable()->constrained('categorias')->onDelete('set null');
            $table->foreignId('proveedor_id')->nullable()->constrained('proveedores')->onDelete('set null');

            $table->decimal('precio_proveedor', 10, 2)->nullable();
            $table->decimal('precio_envio', 10, 2)->nullable();
            $table->decimal('precio_costo', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
