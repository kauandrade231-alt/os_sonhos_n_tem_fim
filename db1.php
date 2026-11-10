<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Sistema de cadastro de produtos </h1>
<h2>
<?php

if ($produtoEditar){

echo "editar produto";



}else{
    echo "Cadastrar Produto";
}

?>
</h2>
<form method="POST">
<?php if ($produtoEditar) {?>
    <input type="hidden" name="id" value="<?=  $produtoEditar['id'] ?>">
    <?php }?>
    <label>Nome do Produto:</label> 
<input type="text"name="nome" value="<?= $produtoEditar ['nome']?? '' ?>">
<br><br>
<label>Preço:</label>
<input type="number" name="preco" step="0.01" min="0" required value="<?=$produtoEditar['preco']?? '' ?>">
<br><br>
<label>Quantidade:</label>
<input type="number" name="quantidade" min="0" required value="<?=$produtoEditar['quantidade']?? '' ?>">
<br><br>
<?php if($produtoEditar){?>
<button type="submit" name="atualizar">Atualizar Produto</button>
<?php}else{?>
<button type="submit" name="cadastrar">cadastrar Produto</button>
<?php}?>
</form>
<hr>
<h2>Produtos Cadastrados</h2>
<table>
<tr>
<th>ID</th>
<th>Nome</th>
<th>Preço</th>
<th>Quantidade</th>
<th>Ações</th>
</tr>
<?php foreach ($produtos as $produto) { ?>

    <tr>
<td><?=  $produto['id'] ?></td>
<td><?= htmlspecialchars($produto['id']) ?> </td>
<td>R$<?= number_format($produto['preco'],2,",",".") ?> </td>
<td><?= $produto["quantidade"] ?></td>
<td>
    <a href="index.php?editar=<?= $produto ['id'] ?> ">Editar</a>
<form method="POST" action="index.php" style="display:inline;">
    <input type="hidden" name="id" value  <?=$produto['id'] ?>>
    <button type="submit" name="excluir" onclick="return confirm
    ('Deseja excluir esse produto?')">Excluir</button>
</form>

</td>
</tr>


<?php } ?>



</table>





</body>
</html>