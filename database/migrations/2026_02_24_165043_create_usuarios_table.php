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
            Schema::create('usuarios', function (Blueprint $table) {
                $table->id();
                $table->string('nome', 100); // Equivalente ao user.nome
                $table->string('email', 100)->unique(); // Equivalente ao user.email e garante que não haja duplicidade
                $table->string('senha', 255); // Equivalente ao user.senha

                // Cria a coluna perfil_id e já define a chave estrangeira (Foreign Key) ligando à tabela perfis
                $table->foreignId('perfil_id')->constrained('perfis')->onDelete('cascade');

                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
