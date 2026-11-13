<?php
require_once "../conexao.php";

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