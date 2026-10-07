<?php

$nome = $_POST["nome"];
$idade = $_POST["idade"];

$resultado = "";

if ($idade >= 18) {
    $resultado = "é de maior";
} else {
    $resultado = "é de menor";
}






?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>autenticador de idade-POST</title>
    <link rel="stylesheet" href="idade.css">
</head>



<body>


    <h1>cadastro-POST</h1>

    <form method="POST">
        <label>Nome:</label>
        <input type="text" class="Nome" id="nome" name="nome">

        <label>IDADE:</label>
        <input type="number" class="idade" id="idade" name="idade">

        <button type="submit"> Cadastrar</button>
    </form>

    <p> <?= $resultado ?> </p>
</body>

</html>
