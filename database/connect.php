<?php
$host = "192.168.10.51";
$dbname = "joao";
$user = "joao";
$pass = "jotinha";

try {
    $conexao = new PDO(
        "pgsql:host=$host;
        dbname=$dbname",
        $user,
        $pass
    );
    echo "Conexão realizada com sucesso!<br>";
} catch (PDOException $e) {
    echo "Erro: ". $e->getMessage();
}
?>
