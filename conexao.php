
<?php


// PHP: linguagem que executa as regras do sistema
//MySql: SGB


// host = 'local host'
$host = 'localhost';
$db = 'kauan755_db1';
$user = 'kauan755';
$pass = '755!@#';
$charset = 'utf8mb4';

try {

    $pdo1 = new PDO("mysql:host=$host;dbname=$db;charset=$charset",

    $user,
    $pass

);


$pdo1->setAttribute(
      PDO::ATTR_ERRMODE,
      PDO::ERRMODE_EXCEPTION
);

echo "CONECTADO COM SUCESSO";


} catch (PDOException $e) {

     echo "ERRO AO CONECTAR AO BANCO DE DADOS:\n";
     echo $e->getMessage();
}

?>

<?php


// PHP: linguagem que executa as regras do sistema
//MySql: SGB


// host = 'local host'
$host = 'localhost';
$db = 'kauan755_db2';
$user = 'kauan755';
$pass = '755!@#';
$charset = 'utf8mb4';

try {

    $pdo2 = new PDO("mysql:host=$host;dbname=$db;charset=$charset",

    $user,
    $pass

);


$pdo2->setAttribute(
      PDO::ATTR_ERRMODE,
      PDO::ERRMODE_EXCEPTION
);

echo "CONECTADO COM SUCESSO";


} catch (PDOException $e) {

     echo "ERRO AO CONECTAR AO BANCO DE DADOS:\n";
     echo $e->getMessage();
}

?>