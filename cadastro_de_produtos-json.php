<?php

echo "DEBUG 1";
//Verifica se o formulario foi enviado usando o método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "DEBUG 2";
    
    
    //recebe as informações para cadastro dos produtos
    $nome_do_produto = $_POST["nome_do_produto"];
    $categoria_do_produto = $_POST["categoria"];
    $marca_do_produto = $_POST["marca"];
    $preco_do_produto = $_POST["preco"];
    $estoque_do_produto = $_POST["estoque"];
    $fabricante_do_produto = $_POST["fabricante"];
    $pais_de_origem = $_POST["pais "];


    echo "DEBUG 2";
    //organiza os dados em um array
    $cadastro = [
        "nome do produto" => $nome_do_produto,
        "categoria"=>$categoria_do_produto,
        "marca"=> $marca_do_produto,
        "preço"=>$preco_do_produto,
        "estoque" => $estoque_do_produto,
        "fabricante"=> $fabricante_do_produto,
        "pais de origem"=>$pais_de_origem,
        

            
        
    ];

    //SERVE PARA LER/ABRIR ARQUIVO JSON

    echo "DEBUG 3";
    $conteudoJson = file_get_contents(__DIR__ . "/dados/produtos.json");

    //SERVE PARA CONVERTAR JSONS PARA ARRAY PHP
    //o true ser para converter o json em array associativo para php ler
    $produtosExixtentes = json_decode($conteudoJson, true);

    //adicionar o novo aluno 

    $produtosExixtentes[] = $cadastro;

    echo "DEBUG 4";
    //CONVERTER O ARRAY PHP PARA JSON

    $jsonatualizado = json_encode(
        $produtosExixtentes,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    );

    //SALVAR NO ARQUIVO JSON

    file_put_contents(__DIR__ . "/dados/produtos.json", $jsonatualizado);
}


echo "DEBUG 5";
//lê o arquivo JSON


$conteudoJson = file_get_contents(__DIR__ . "/dados/produtos.json");

//converte o JSON para ARRAY PHP

$produtosCadastrados = json_decode($conteudoJson, true);

echo "DEBUG 6";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento</title>
</head>

<body>
    <h1>CADASTRO PRODUTOS</h1>
    <form method="POST">
        <label>"Nome do produto:</label>
        <input type="text" name="nome_do_produto" required>
        <br><br>

         <label>categoria</label>
        <input type="text" name="categoria" min="0" max="10" step="0.1" required>
        <br><br>
        
        <label>Marca:</label>
        <input type="text" name="marca" min="0" max="10" step="0.1" required>
        <br><br>
        
       
        
        <label>Preço:</label>
        <input type="number" name="preco" min="0" max="10" step="0.1" required>
        <br><br>
        <label>Estoque:</label>
        <input type="number" name="estoque" min="0" max="10" step="0.1" required>
        <br><br>
        
        <label>Fabricante:</label>
        <input type="text" name="fabricante" min="0" max="10" step="0.1" required>
        <br><br>
       
        <label>Pais:</label>
        <input type="text" name="pais" min="0" max="10" step="0.1" required>

        <button type="submit">Cadastrar</button>

       
    </form>

    <h1>PRODUTOS CADASTRADOS</h1>

    <?php foreach ($produtosCadastrados as $item) { ?>

        <h2> <?= $item["nome do produto"]  ?> </h2>
        <p>categoria<?= $item["categoria"] ?> </p>
        
        <p>Marca: <?= $item["Marca"] ?></p>
       
        <p>Preço: <?= $item["preço"] ?></p>
       
        <p>Estoque: <?= $item["estoque"] ?></p>

        <p>Fabricante: <?= $item["fabricante"] ?></p>

        <p>Pais: <?= $cadastro["pais de origem"] ?></p>
        


    <?php } ?>












</body>

</html>