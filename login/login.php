<?php require_once __DIR__ . '/../includes/functions.php';?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php';?>
    <main>
        <h1>Faça o seu Login</h1>
        <form action="" method="post">
            <label for="email">Email: </label>
            <input type="text" name="email" id="email" placeholder="Digite seu e-mail"><br>
            <label for="senha">Senha: </label>
            <input type="password" name="senha" id="senha" placeholder="Digite sua senha"><br>
            <input type="submit" value="Entrar">
            <input type="reset" value="Limpar">
        </form>

        <?php
        if($_SERVER['REQUEST_METHOD'] == "POST"){
        $usuario = consulta_user($conexao, $_POST['email']);

            if($usuario['email'] == $_POST['email'] && $usuario['senha'] == $_POST['senha']){
                session_start();
                $_SESSION['id'] = $usuario['id'];
                header("Location: /mini_sistema/index.php");
                exit();
            } else {
                echo "E-mail ou senha inválido(s).";
            }
        }
        ?>
    </main>
    <?php include __DIR__ . '/../includes/footer.php';
    ?>
</body>
</html>