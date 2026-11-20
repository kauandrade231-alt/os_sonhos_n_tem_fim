<?php
// Objetivo: localizar, explicar e corrigir vulnerabilidades.

//Display_errors, 0 =Não exibir erros internos para qualquer usuario.
require_once "banco.sql";
ini_set('display_errors', 0);

//Log_errors, '1' - Registra os logs num arquivo interno o qual o usuario padrão não possui acesso
ini_set('log_errors', '1');

//Define quais tipos de erros o PHP de registrar,[E_ALL]-todos os erros.
error_reporting(E_ALL);

session_start();

$host = '127.0.0.1';

$banco = 'kauan755';

$usuario = 'kauan755dv2';

$senha = '755!@#';

try {

    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8mb4", $usuario, $senha);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    error_log($e->getMessage());
    http_response_code(500);
    exit('Erro interono de conexão. ');
}

$mensagem = $_GET['msg'] ?? '';
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$acao = $_POST['acao'] ?? $_GET['acao'] ?? '';
}
if ($acao === 'login') {

    $email = $_POST['email'] ?? '';
    echo "Olá, " . htmlspecialchars(
    
        $email, 
    
        ENT_QUOTES | ENT_SUBSTITUTE, 
    
        'UTF-8'
    );

    $password = $_POST['senha'] ?? '';
    echo "Olá, " . htmlspecialchars(
    
        $email, 
    
        ENT_QUOTES | ENT_SUBSTITUTE, 
    
        'UTF-8'
    );

    $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :password";
    
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        'email' => $email,
        'password' => $password
    ]);

    $encontrado = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

    if ($encontrado) {

        $_SESSION['usuario'] = $encontrado['nome'];

        $_SESSION['perfil'] = $encontrado['perfil'];

        $mensagem = 'Bem-vindo, ' . $encontrado['nome'];

    } else { $mensagem = 'Login inválido para ' . $email; }

}

if ($acao === 'sair') { session_destroy(); header('Location: index.php?msg=Você saiu'); exit; }

if ($acao === 'cadastrar') {

    $nome = trim($_POST['nome'] ?? '') ; //LEVE ALTERAÇÃO.ADICIONADO "trim($_POST['...'] ?? '');" 

    $descricao = trim($_POST['descricao'] ?? '') ; //LEVE ALTERAÇÃO.ADICIONADO "trim($_POST['...'] ?? '');"

    $preco = filter_input(INPUT_POST, 'preco',
            FILTER_VALIDATE_FLOAT) ; //LEVE ALTERAÇÃO.ADICIONADO flter_input(INPUT_POST, '...', FILTER_VALIDATE_FLOAT );

    $estoque =filter_input(INPUT_POST, 'estoque', 
                            FILTER_VALIDATE_FLOAT) ; //LEVE ALTERAÇÃO.ADICIONADO flter_input(INPUT_POST, '...', FILTER_VALIDATE_FLOAT );

    $categoria =trim($_POST['categoria'] ?? '') ; //LEVE ALTERAÇÃO.ADICIONADO "trim($_POST['...'] ?? '');"

    $sql = "INSERT INTO produtos (nome, descricao, preco, estoque, categoria) 
    VALUES (:nome, :descricao, :preco, :estoque, :categoria)"; //LEVE ALTERAÇÃO.TROCADO '$' POR ':'

    $stmt = $pdo->prepare($sql);
    $stmt -> execute([
        ':nome' => $nome,
        ':descricao' => $descricao,
        ':preco' => $preco,
        ':estoque' => $estoque,
        ':categoria' => $categoria
    ]); //ADICIONEI UMA COLUNA. ultilizei '$stmt' por '$ttmt' poder está com um erro mas n sei dizer se falta algum comando ou oq está nas imagens oferecidas estão com um erro de renderização

    $pdo->exec($sql);

    $mensagem = "Produto $nome cadastrado!";

}

if ($acao === 'atualizar') {

    $id = $_POST['id'] ?? '';

    $nome = $_POST['nome'] ?? '';

    $descricao = $_POST['descricao'] ?? '';

    $preco = $_POST['preco'] ?? '';

    $estoque = $_POST['estoque'] ?? '';

    $categoria = $_POST['categoria'] ?? '';

    $sql = "UPDATE produtos SET nome='$nome', descricao='$descricao', preco='$preco', estoque='$estoque', categoria='$categoria' WHERE id=$id";

    $pdo->exec($sql);

    $mensagem = 'Produto atualizado.';

}

if ($acao === 'excluir') {

    $id = $_GET['id'] ?? '';

    $pdo->exec("DELETE FROM produtos WHERE id=$id");

    $mensagem = 'Produto excluído.';

}

$busca = $_GET['busca'] ?? '';
$sql = "SELECT * FROM produtos WHERE busca = :busca";
$stmt = $pdo->prepare($sql);
$stmt -> execute(['busca' => $busca]); //ADICIONEI

$categoriaFiltro = $_GET['categoria'] ?? '';
$sql = "SELECT * FROM produtos WHERE categoria = :categoria";
$stmt = $pdo->prepare($sql);
$stmt -> execute(['categoria' => $categoria]); //ADICIONEI

$ordem = $_GET['ordem'] ?? 'id';

$sqlLista = "SELECT * FROM produtos WHERE (nome LIKE:buscaNome OR descricao LIKE :buscaDescricao)";

$parametros = [
    'buscaNome' => "%$busca%",
    'buscaDescricao' => "%$busca%"
];
if ($categoriaFiltro !== '') {
    
    $sqlLista .= " AND categoria = '$categoriaFiltro'" ;}

$sqlLista .= " ORDER BY $ordem";

$produtos = $pdo->query($sqlLista)->fetchAll(PDO::FETCH_ASSOC);
$editar = null;

if (isset($_GET['editar'])) {

    $editar = $pdo->query('SELECT * FROM produtos WHERE id=' . $_GET['editar'])->fetch(PDO::FETCH_ASSOC);

}

$total = $pdo->query('SELECT COUNT(*) FROM produtos')->fetchColumn();
//ENT_QUOTES = É uma 'constante' que indica que tanto as aspas simples quanto as aspas duplasdevem ser convertidas em entidades html.
//UTF-8 = Permite  trabalhar com caractres

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Estoque Fácil — Laboratório</title>
<link rel="stylesheet" href="style.css">

</head>

<body>

<header>

    <h1>Estoque Fácil</h1>

    <p>Sistema de estoque da loja fictícia</p>

</header>

<main>

<div class="aviso">LABORATÓRIO INSEGURO — SOMENTE LOCALHOST</div>

<?php if ($mensagem !== ''): ?>
    <div class="mensagem"><?= $mensagem ?>
</div>

<?php endif; ?>

    <section class="painel">

    <h2>Acesso ao sistema</h2>

    <?php if (isset($_SESSION['usuario'])): ?>

        <p>Usuário: <?= $_SESSION['usuario'] ?> | Perfil: <?= $_SESSION['perfil'] ?></p>

        <a href="?acao=sair">Sair</a>

        <?php else: ?>

            <form method="post"><input type="hidden" name="acao" value="login">

            <label>E-mail <input name="email" placeholder="email@exemplo.local"></label>

            <label>Senha <input name="senha" type="text" placeholder="Senha"></label>

            <button>Entrar</button></form>

            <?php endif; ?>

        </section>

        <section class="painel"><h2><?= $editar ? 'Editar produto' : 'Cadastrar produto' ?></h2>


        <form method="post" class="grade">

        <input type="hidden" name="acao" value="<?= $editar ? 'atualizar' : 'cadastrar' ?>">

        <?php if ($editar): ?><input type="hidden" name="id" value="<?= $editar['id'] ?>"><?php endif; ?>

    <label>Nome <input name="nome" value="<?= $editar['nome'] ?? '' ?>"></label>

    <label>Categoria <input name="categoria" value="<?= $editar['categoria'] ?? '' ?>"></label>

    <label>Preço (R$) <input name="preco" value="<?= $editar['preco'] ?? '' ?>"></label>


    <label>Estoque <input name="estoque" value="<?= $editar['estoque'] ?? '' ?>"></label>

    <label class="largura">Descrição <textarea name="descricao"><?= $editar['descricao'] ?? '' ?></textarea></label>

    <div><button><?= $editar ? 'Salvar alterações' : 'Cadastrar' ?></button> <a href="index.php">Limpar</a></div>

</form></section>

<section class="painel"><h2>Produtos cadastrados (<?= $total ?>)</h2>

<form method="get" class="filtros">

<input name="busca" placeholder="Buscar nome ou descrição" value="<?= $busca ?>">

<input name="categoria" placeholder="Filtrar categoria" value="<?= $categoriaFiltro ?>">

<select name="ordem"><option value="id">Código</option><option value="nome">Nome</option><option value="preco">Preço</option><option value="<?= $ordem ?>" selected>Ordenação atual</option></select>

<button>Pesquisar</button></form>

<div class="tabela"><table><thead><tr><th>ID</th><th>Nome</th><th>Descrição</th><th>Categoria</th><th>Preço</th><th>Estoque</th><th>Ações</th></tr></thead><tbody>

<?php foreach ($produtos as $produto): ?>

    <tr><td><?= $produto['id'] ?></td><td><?= $produto['nome'] ?></td><td><?= $produto['descricao'] ?></td><td><?= $produto['categoria'] ?></td><td>R$ <?= $produto['preco'] ?></td><td><?= $produto['estoque'] ?></td>

    <td><a href="?editar=<?= $produto['id'] ?>">Editar</a> <a href="?acao=excluir&id=<?= $produto['id'] ?>">Excluir</a></td></tr>

    <?php endforeach; ?>

</tbody></table></div>

</section>

<section class="painel"><h2>Observações da loja</h2><p>Esta página foi criada para a turma identificar problemas reais de desenvolvimento web.</p>

<p>Mensagem de campanha: <?= $_GET['campanha'] ?? 'Nenhuma campanha ativa' ?></p></section>

</main><footer>Estoque Fácil • Ambiente de laboratório</footer>

</body></html>

<!--
comandos mau organizados.
adicionei comandos para maior proteção do codigo

!>