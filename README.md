## Iniciar projeto

1. Baixar XAMP - PHP e MySQL
2. Baixar Composer
3. Descomentar ZIP no config do Apache
4. Adicionar .env com modelo no arquivo .env.sample
5. npm i artisan

## Rodar projeto

1. composer install ou composer update
2. php artisan migrate
2. rodar: php artisan serve

## Criar controller

1. Sem actions: php artisan make:controller AutenticacaoController
2. CRUD: php artisan make:controller AutenticacaoController –resources

# convenções de tabelas
1. nome das tabelas no plural
2. ex nome: create_teste_table

## Adicionar campo 'role' na tabela usuários
1. php artisan make:migration add_role_to_users_table
2. php artisan migrate

## Rollback na migrate
1. php artisan migate:rollback
2. php artisan migate:rollback --step=2

## Criar model
1. php artisan make:model Post

## Iniciar auth
1. composer require laravel/ui
2. php artisan ui bootstrap --auth


## link cidades e estados sql
https://zerobugs.com.br/ver-post/codigo-sql-com-todas-as-cidades-e-estados-do-brasil-62/

## Anotações paginação perguntas a ser desenvolvida

1.Rota
    `Route::name('pergunta.salvar')->post('salvar/{pergunta}', [ControllerController::class, 'salvar']);`  


2. Controller
    `public function salvar(Request $request, Pergunta $pergunta)`
    `{`
        `//salva`
        `return redirect()->route('pergunta.view', ['pergunta' => $pergunta->proximaPerguntaID]);`
    `}`

3. View
    `<form method="POST" action="{{ route('pergunta.salvar', ['pergunta' => $pergunta->id]) }}">`
        `@csrf`
    `</form>`


## Para usar cmd do laravel:

`php artisan tinker`
`\App\Models\Answer::first()->delete();`

## Roleta 

`dougtesting.net/`

## Comando para criar turma

`php artisan cria:turma` 