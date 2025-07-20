<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    /*
);
    */
    public function up(): void
    {
        Schema::create('quesrions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string(column: 'question_text');
            $table->enum('question_type', ['text', 'single', 'multiple', 'scale', 'boolean']);
            $table->json('options')->nullable(); // Solo se usa para preguntas con opciones (radio, checkboxes, etc.)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quesrions');
    }
};
