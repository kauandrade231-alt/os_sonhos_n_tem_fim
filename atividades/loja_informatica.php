<?php
require_once "../conexao.php";
$produtoEditar = null;
//TEBELA CATEGORIA

$sqlCategorias = "CREATE TABLE IF NOT EXISTS categorias(
     id INT AUTO_INCREMENT PRIMARY KEY ,
     nome VARCHAR(100) NOT NULL

)";
$pdo2->exec($sqlCategorias);

//TABELA PRODUTO

$sqlProdutos = "CREATE TABLE IF NOT EXISTS produtos( 
    id INT AUTO_INCREMENT PRIMARY KEY, 
    nome VARCHAR(150) NOT NULL,
    categoria_id INT,
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT NOT NULL,
    estoque_minimo INT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
 )";

$pdo2->exec($sqlProdutos);

//TABELA VENDAS

$sqlVendas = "CREATE TABLE IF NOT EXISTS vendas(
    id INT AUTO_INCREMENT PRIMARY KEY, 
    produtos_id INT,
    quantidade INT NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    data_venda DATETIME NOT NULL,
    FOREIGN KEY (produtos_id) REFERENCES produtos(id)
)";
$pdo2->exec($sqlVendas);

//CADASTRAR PRODUTOS:categorias


if (isset($_POST["cadastrar_categoria"])) {
    $nome = $_POST["nome"];

    $sqlCategorias = "INSERT INTO categorias(nome) VALUES ('$nome')";
    $pdo2->exec($sqlCategorias);
}

//CADASTRAR PRODUTOS:produtos

if (isset($_POST["cadastrar_produto"])) {
    $nome = $_POST["nome"];
    $categoria_id = $_POST["categoria_id"];
    $preco = $_POST["preco"];
    $quantidade = $_POST["quantidade"];
    $estoque_minimo = $POST["estoque_minimo"];

    $sqlProdutos = "INSERT INTO produtos(nome,categoria_id,preco,quantidade,estoque_minimo) VALUES ('$nome',$categoria_id,$preco,$quantidade,$estoque_minimo)";
    $pdo2->exec($sqlProdutos);
}

//CADASTRAR PRODUTOS:vendas

if (isset($_POST["cadastrar_venda"])) {
    $produtos_id = $_POST["produtos_id"];
    $quantidade = $_POST["quantidade"];
    $valor_total = $_POST["valor_total"];
    $data_venda = $_POST["data_venda"];

    $sqlVendas = "INSERT INTO vendas(produtos_id,quantidade,valor_total,'data_venda') VALUES ( $produtos_id, $quantidade, $valor_total, $data_venda)";
    $pdo2->exec($sqlVendas);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja</title>
</head>
<body>
<h1>sistema de cadastro</h1>
    <h2>
    <?php
            if ($produtoEditar) {
                echo "Editar produto";
            }
            else {
                echo "Cadastrar produto";
            }
        ?> 
    </h2>

    <form method="POST">
        <?php if ($produtoEditar) { ?>
            <input type="hidden" name="id" value="<?= $produtoEditar['id'] ?>">
        <?php } ?>

        <label>Nome do Produto:</label>
        <input type="text" name="nome" required value="<?= $produtoEditar['nome'] ?? '' ?>">
        <br><br>

        <label>Categoria:</label>
        <select name="categoria_id" required>
            <option value="">Selecione...</option>
            <?php foreach ($categorias as $categoria) { ?>
                <option value="<?= $categoria['id'] ?>" 
                    <?php if ($produtoEditar['categoria_id'] == $categoria['id']) { echo "selected"; } ?>>
                    <?= $categoria['nome'] ?>
                </option>
            <?php } ?>
        </select>
        <br><br>

        <label>Preço:</label>
        <input type="number" name="preco" step="0.01" min="0.01" required value="<?= $produtoEditar['preco'] ?? '' ?>">
        <br><br>

        <label>Quantidade disponível:</label>
        <input type="number" name="quantidade" min="0" required value="<?= $produtoEditar['quantidade'] ?? '' ?>">
        <br><br>

        <label>Estoque mínimo:</label>
        <input type="number" name="estoque_minimo" min="0" required value="<?= $produtoEditar['estoque_minimo'] ?? '' ?>">
        <br><br>

        <?php if ($produtoEditar) { ?>
            <button type="submit" name="atualizar">Atualizar Produto</button>
        <?php } else { ?>
            <button type="submit" name="cadastrar">Cadastrar Produto</button>
        <?php } ?>
    </form>

    <hr>
    <h2>Produtos Cadastrados</h2>

    <tr>
     <th>ID</th>
     <th>Nome</th>
     <th> Categoria</th>
    <th>Preço</th>
    <th>Quantidade disponível</th> 
    <th>Estoque mínimo</th>
    <th>Situação do estoque</th>
    </tr>
            <?php foreach ($produtos as $produto) {?>
            
            
            
            <?php } ?>

</body>
</html>