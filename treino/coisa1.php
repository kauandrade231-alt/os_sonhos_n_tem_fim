<?php 

$arquivo=__DIR__ . "/dados/coisa.json";


$conteudo = file_get_contents($arquivo);

$alunos = json_decode($conteudo,true);

foreach($alunos as $posicao =>$aluno){
//procura aluno com o nome Maria
if($aluno["nome"]=="Maria"){

        //excluir o aluno
        unset($alunos[$posicao]);

}


}



$json = json_encode($alunos,
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    file_put_contents($arquivo,$json);














?>