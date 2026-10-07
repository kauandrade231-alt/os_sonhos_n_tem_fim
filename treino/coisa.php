<?php

$arquivo=__DIR__ . "/dados/coisa.json";


$conteudo = file_get_contents($arquivo);

$alunos = json_decode($conteudo,true);

foreach($alunos as $aluno){

if($aluno["nome"]== "Maria"){
    $aluno["idade"]=15;
}


}

$alunos = array_values($aluno);

$json = json_encode($alunos,
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    file_put_contents($arquivo,$json);

?>













<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>