<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    // Diz qual é a tabela exata no banco (igual ao __tablename__ = "perfis")
    protected $table = 'perfis';

    // Libera as colunas que podem ser preenchidas em massa
    protected $fillable = ['perfil_nome'];

    // Relacionamento: Um perfil tem um usuário (igual ao back_populates="perfil")
    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'perfil_id');
    }
}
