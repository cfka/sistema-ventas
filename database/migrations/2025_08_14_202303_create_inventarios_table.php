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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos')->cascadeOnDelete();

            $table->foreignId('usuario_id')->nullable()->constrained('users')->nullOnDelete();

            $table->integer('stock')->default(0); 
            $table->decimal('precio_vendedor', 12, 2)->nullable();
            $table->decimal('precio_venta', 12, 2)->nullable();

            // disponible | en_transito | agotado | inactivo
            $table->string('estado')->default('disponible');
            $table->timestamps();

            $table->unique(['producto_id', 'usuario_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};
