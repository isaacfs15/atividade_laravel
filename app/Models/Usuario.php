<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    // Diz qual é a tabela no banco (igual ao __tablename__ = "usuarios")
    protected $table = 'usuarios';

    // Libera as colunas para preenchimento
    protected $fillable = ['nome', 'email', 'senha', 'perfil_id'];

    // Oculta a senha nos retornos JSON da API
    protected $hidden = ['senha'];

    // Relacionamento: Um usuário pertence a um perfil (igual ao back_populates="usuario")
    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'perfil_id');
    }
}
