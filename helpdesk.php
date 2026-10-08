<?php
$arquivo="dados/chanados.json";
require_once "helpdesk-func.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome=$_POST["nome"];
    $setor= $_POST["setor"];
    $equipamentoDanificado=$_POST["equipamentoDanificado"];

}

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
    <input type="text" name="nome">
    <label>Setor de trabalho</label>
    <input type="text" name="setor">

    
</form>
</body>
</html>