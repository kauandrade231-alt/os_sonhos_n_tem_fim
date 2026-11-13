<?php
require_once "../conexao.php";

$sqlCategorias = "CREATE TABLE IF NOT EXISTS categorias(
     id INT AUTO_INCREMENT PRIMARY KEY ,
     nome VARCHAR(100) NOT NULL

)";
$pdo2->exec($sqlCategorias);

$sqlProdutos = "CREATE TABLE IF NOT EXISTS produtos( 
    id INT AUTO_INCREMENT PRIMARY KEY, 
    nome VARCHAR(150) NOT NULL,
    categoria_id INT,
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT NOT NULL,
    estoque_minimo INT NOT NULL
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
 )";

$pdo2->exec($sqlProdutos);

$sqlVendas = "CREATE TABLE IF NOT EXISTS vendas(
    id: INT AUTO_INCREMENT PRIMARY KEY, 
    produto_id INT,
    quantidade: INT NOT NULL,
    valor_total: DECIMAL(10,2) NOT NULL,
    data_venda: DATETIME NOT NULL,
    FOREIGN KEY (produto_id) REFERENCES produto(id)
)";
$pdo2->exec($sqlVendas)



?>