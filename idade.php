<?php

    $nome = $_POST["nome"];
    $idade=$_POST["idade"] ;
  
    $resultado = "";

    if($idade>=18){
        $resultado = "é de maior";

    }else{
        $resultado ="é de menor";
    }






?>

<p> <?= $resultado ?> </p>
<!DOCTYPE html>
<body>
    <header>
        <nav>
         <form method="POST"></form>
        </nav>
    </header>
    </body>
    <main>
        <section class="Cadastro">
           
        <h1>cadastro</h1>
        
        <form method="POST">


         <label>Nome:</label>
    <input type="text" class="Nome"_id="nome" name="nome">
    
    <label>IDADE:</label>
    <input type="number" class="idade"_id="idade" name="idade">
    <button type="submit"> Cadastrar</button>
        </form>
   
    
    
         </form>
        </section>
    </main>
    </body>
    
