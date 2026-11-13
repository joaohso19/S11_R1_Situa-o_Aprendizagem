<?php require_once __DIR__ . '/../includes/functions.php';?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php';?>
    <main>
        <h1>Cadastre-se no Sistema</h1>
        <form action="" method="post">
            <label for="email">Email: </label>
            <input type="text" name="email" id="email" placeholder="Digite seu e-mail"><br>
            <label for="senha">Senha: </label>
            <input type="password" name="senha" id="senha" placeholder="Digite sua senha"><br>
            <input type="submit" value="Cadastrar">
            <input type="reset" value="Limpar">
        </form>
        <?php
        if($_SERVER['REQUEST_METHOD'] == "POST"){
        cadastrar_user($conexao, $_POST['email'], $_POST['senha']);
        header("Location: /mini_sistema/index.php");
        exit();
        }
        ?>
    </main>
    <?php include __DIR__ . '/../includes/footer.php';
    ?>
</body>
</html>
