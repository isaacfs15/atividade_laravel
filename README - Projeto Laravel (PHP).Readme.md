# CRUD de Usuário com Perfil - Laravel API

Esta é uma API RESTful desenvolvida em PHP utilizando o framework Laravel. O projeto atende aos requisitos da atividade prática de implementação de Mapeamento Objeto-Relacional (ORM), demonstrando um relacionamento 1:1 entre Usuários e Perfis.

## 🛠️ Tecnologias e Versões
* **Linguagem:** PHP (v8.1 ou superior)
* **Framework:** Laravel (v11.x)
* **ORM:** Eloquent ORM (Integrado ao Laravel)
* **Banco de Dados:** MySQL

## 📦 Dependências
O gerenciamento de dependências é feito via Composer. As principais dependências exigidas pelo framework são instaladas por padrão, garantindo o funcionamento do roteamento, banco de dados e criptografia (Hash).

## 🚀 Como Executar o Projeto
1. Clone o repositório para sua máquina local.
2. Navegue até a pasta do projeto via terminal.
3. Instale as dependências executando o comando: `composer install`
4. Crie uma cópia do arquivo de ambiente padrão: `cp .env.example .env`
5. Gere a chave de segurança da aplicação: `php artisan key:generate`
6. Abra o arquivo `.env` e configure suas credenciais de banco de dados (certifique-se de criar o banco `atividade_laravel` no MySQL):
   `DB_DATABASE=atividade_laravel`
   `DB_USERNAME=root`
   `DB_PASSWORD=`
7. Execute as migrations para gerar as tabelas no banco de dados: `php artisan migrate`
8. Inicie o servidor de desenvolvimento: `php artisan serve`

## 🧪 Testando com o Postman
Com o servidor rodando em `http://localhost:8000`, utilize o Postman para testar os seguintes endpoints:

* **Criar Usuário (POST):** `http://localhost:8000/api/usuarios`
  * Vá em **Body** > **raw** > **JSON** e envie a seguinte estrutura:
    ```json
    {
        "nome": "João Silva",
        "email": "joao@exemplo.com",
        "senha": "senha_segura",
        "perfil": {
            "perfil_nome": "Administrador"
        }
    }
    ```
* **Listar Usuários (GET):** `http://localhost:8000/api/usuarios`
* **Deletar Usuário (DELETE):** `http://localhost:8000/api/usuarios/{id}` (substitua `{id}` pelo ID numérico do usuário criado).
