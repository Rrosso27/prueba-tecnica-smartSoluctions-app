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
        Schema::table('quesrions', function (Blueprint $table) {
            // Primero eliminar la restricción de clave foránea
            // Usar el nombre específico que genera Laravel por defecto
            $table->dropForeign('quesrions_user_id_foreign');
            // Luego eliminar la columna
            $table->dropColumn('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quesrions', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }
};
