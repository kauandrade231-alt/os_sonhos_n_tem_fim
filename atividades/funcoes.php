<?php

$nomeEscola = "SENAI";
//exiba mensagem
function saudacao()
{
    return "Bem vindo ao sistema!";
}
//recebe nome
function cumprimentar($nome)
{
    return "Olá" . $nome . "!";
}
//somar dois numeros
function somar($numero1, $numero2)
{
    $resultado = $numero1 + $numero2;

    return $resultado;
}

function calcularMedia($nota1, $nota2)
{
    $media = ($nota1 + $nota2) / 2;
    return $media;
}

function verificarStatus($media)
{
    //media é 7



}
