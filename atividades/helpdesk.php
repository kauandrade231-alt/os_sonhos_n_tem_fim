<?php
$arquivo="dados/chamados.json";
require_once "helpdesk-func.php";

$mensagemErro = "";
$mensagemSucesso = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome=$_POST["nome"];
    $setor= $_POST["setor"];
    $equipamento=$_POST["equipamentoDanificado"];
    $problema=$_POST["problemaEncontrado"];
    $Prioridade=$_POST["nivelPrioridade"];

    $cadastro=[
    "nome" => $nome,
    "setor" => $setor,
    "equipamento"=>$equipamento,
    "problema"=>$problema,
    "nivel de prioridade"=>$Prioridade,




    ];
    $conteudoJson = file_get_contents(__DIR__."/dados/chamados.json");


    $problemasExixtentes = json_decode($conteudoJson,true);

    $problemasExixtentes[] = $cadastro;

    $jsonatualizado = json_encode(
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    );

    file_put_contents(__DIR__. "/dados/chamados.json",$jsonatualizado);

    }

    $conteudoJson= file_get_contents(__DIR__."/dados/chamados.json");

    $problemasCadastrados = json_decode($conteudoJson,true);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>assistencia tecninica</title>
</head>
<body>
    <form method="POST">
    <label>Seu nome:</label>
    <input type="text" name="nome" required>
    <label>Setor de trabalho</label>
    <input type="text" name="setor" required>
    <label>problema encontrado</label>
    <input type="text" name= "problema"required>
    <label>nivel de prioridade</label>
    <input type="text" name= "prioridade" required> 

        <button type="submit">Cadastrar</button>

</form>
<h1>PROBLEMAS CADASTRADOS</h1>

<?php foreach($problemasCadastrados as $item)?> { 
<h2><?= $item["Registro"] ?></h2>
<p>Nome do funcionario: <?=$item["nome"]?></p>
<p>Setor do funcionario: <?=$item["setor"]?></p>
<p>Problema Encontrado: <?=$item["problema"]?></p>
<p>Nivel de prioridade: <?=$item["prioridade"]?></p>
<php}?> 
</body>
</html>