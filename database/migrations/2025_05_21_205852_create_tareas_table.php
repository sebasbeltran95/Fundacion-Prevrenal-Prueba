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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo',100)->nullable();
            $table->text('descripcion')->nullable();
            $table->date('fecha_creacion')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->integer('id_estado')->nullable();
            $table->integer('id_prioridad')->nullable();
            $table->integer('id_categoria')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('id_proyectos')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
