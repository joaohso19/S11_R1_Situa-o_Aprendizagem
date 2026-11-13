<?php require_once __DIR__ . '/../includes/functions.php';?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta</title>
</head>

<body>
    <?php include __DIR__ . '/../includes/header.php';?>
    <h1>Consultar Aluno</h1>
    <form action="" method="post">
        <label for="id">ID: </label>
        <input type="number" name="id" id="id" placeholder="Informe o ID do aluno" required><br>
        <input type="submit" value="Consultar">
    </form>
    <?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        consultar($conexao, $_POST['id']);
    }
    ?>
    <?php include __DIR__ . '/../includes/footer.php';?>
</body>

</html>

<?php 
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
if(!isset($_SESSION['id'])){
    header("Location: ../login/login.php");
    exit();
}
?>