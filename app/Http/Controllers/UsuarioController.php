<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Perfil;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // Equivalente ao @app.get("/usuarios/")
    public function index()
    {
        // Puxa todos os usuários e já inclui os dados do perfil associado
        return response()->json(Usuario::with('perfil')->get());
    }

    // Equivalente ao @app.post("/usuarios/")
    public function store(Request $request)
    {
        // 1. Validação (Substitui o Pydantic e a checagem manual de e-mail)
        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email|max:100', // Já retorna erro se o email existir
            'senha' => 'required|string',
            'perfil.perfil_nome' => 'required|string|max:50', // Valida o JSON aninhado do perfil
        ]);

        // 2. DB Transaction garante que se der erro no meio, nada é salvo (segurança extra)
        $usuario = DB::transaction(function () use ($validated, $request) {

            // Cria o perfil primeiro
            $perfil = Perfil::create([
                'perfil_nome' => $request->input('perfil.perfil_nome')
            ]);

            // Cria o usuário e vincula o ID do perfil gerado
            $usuario = Usuario::create([
                'nome' => $validated['nome'],
                'email' => $validated['email'],
                'senha' => Hash::make($validated['senha']), // Criptografa a senha (boa prática no PHP!)
                'perfil_id' => $perfil->id
            ]);

            return $usuario;
        });

        // Retorna o usuário criado carregando os dados do perfil junto (Status 201 = Created)
        return response()->json($usuario->load('perfil'), 201);
    }

    // Equivalente ao @app.delete("/usuarios/{user_id}")
    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        // Se não achar o usuário, retorna erro 404
        if (!$usuario) {
            return response()->json(["detail" => "Usuário não encontrado!"], 404);
        }

        $perfilId = $usuario->perfil_id;

        // Deleta o usuário primeiro (por causa da chave estrangeira), depois o perfil
        $usuario->delete();
        Perfil::destroy($perfilId);

        return response()->json(["mensagem" => "Usuário e perfil deletados com sucesso!"]);
    }
}
