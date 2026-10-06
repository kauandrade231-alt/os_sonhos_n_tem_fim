<?php

echo "DEBUG 1";
//Verifica se o formulario foi enviado usando o método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "DEBUG 2";
    
    
    //recebe as informações para cadastro dos produtos
    $nome = $_POST["nome do preoduto"];
    $categoria = $_POST["categoria"];
    $marca = $_POST["marca"];
    $preco = $_POST["preço"];
    $estoque = $_POST["estoque"];
    $fabricante = $_POST["fabricante"];
    $paias = $_POST["pais de origem"];


    echo "DEBUG 2";
    //organiza os dados em um array
    $cadastro = [
        "nome do produto" => $nome,
        "categoria"=>$categoria,
        "marca"=> $marca,
        "preço"=>$preco,
        "estoque" => $estoque,
        "fabricante"=> $fabricante,
        "pais de origem"=>$pais,
        

            
        
    ];

    //SERVE PARA LER/ABRIR ARQUIVO JSON

    echo "DEBUG 3";
    $conteudoJson = file_get_contents(__DIR__ . "/dados/produtos.json");

    //SERVE PARA CONVERTAR JSONS PARA ARRAY PHP
    //o true ser para converter o json em array associativo para php ler
    $cadastro = json_decode($conteudoJson, true);

    //adicionar o novo aluno 

    $cadastro[] = $novocadastro;

    echo "DEBUG 4";
    //CONVERTER O ARRAY PHP PARA JSON

    $jsonatualizado = json_encode(
        $cadastro,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    );

    //SALVAR NO ARQUIVO JSON

    file_put_contents(__DIR__ . "/dados/produtos.json", $jsonatualizado);
}


echo "DEBUG 5";
//lê o arquivo JSON

$conteudoJson = file_get_contents(__DIR__ . "/dados/produtos.json");

//converte o JSON para ARRAY PHP

$cadastro = json_decode($conteudoJson, true);

echo "DEBUG 6";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>CADASTRO PRODUTOS</h1>
    <form method="POST">
        <label>"Nome do produto:</label>
        <input type="text" name="nome" required>
        <br><br>
        <label>categoria:</label>
        
        
        <label>Marca:</label>
        <input type="text" name="marca_do_produto" min="0" max="10" step="0.1" required>
        <br><br>
        
        <label>categoria</label>
        <input type="text" name="categoria_do_produto" min="0" max="10" step="0.1" required>
        <br><br>
        
        <label>Preço:</label>
        <input type="number" name="preço_do_produto" min="0" max="10" step="0.1" required>
        <br><br>
        <label>Estoque:</label>
        <input type="number" name="estoque_de_produto" min="0" max="10" step="0.1" required>
        <br><br>
        
        <label>Fabricante:</label>
        <input type="number" name="fabricante" min="0" max="10" step="0.1" required>
        <br><br>
       
        <label>Pais:</label>
        <input type="text" name="pais_de_origem" min="0" max="10" step="0.1" required>

       
    </form>

    <h1>PRODUTOS CADASTRADOS</h1>

    <?php foreach ($cadastros as $cadastro) { ?>

        <h2> <?= $cadastro["nome"]  ?> </h2>
        <p>produto<?= $cadastro["categoria"] ?> </p>
        
        <p>Marca: <?= $cadastro["cadastro"]["produto"] ?></p>
       
        <p>Peço: <?= $cadastro["cadastro"]["produto"] ?></p>
       
        <p>Categoria: <?= $cadastro["categoria"]["produto"] ?></p>

        <p>Fabricante: <?= $cadastro["fabricante"] ?></p>

        <p>Pais: <?= $cadastro["pais"] ?></p>
        


    <?php } ?>












</body>

</html>