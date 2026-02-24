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
            Schema::create('perfis', function (Blueprint $table) {
                $table->id(); // Equivalente ao seu id = Column(Integer, primary_key=True)
                $table->string('perfil_nome', 50); // Equivalente ao seu perfil_nome = Column(String(50))
                $table->timestamps(); // Cria as colunas created_at e updated_at automaticamente
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfis');
    }
};
