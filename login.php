<?php
include('db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar se os campos de e-mail e senha foram preenchidos
    if (isset($_POST['txtemail']) && isset($_POST['txtsenha'])) {
        $email = $_POST['txtemail'];
        $senha = $_POST['txtsenha'];

        // Verificar o e-mail no banco de dados
        $sql = "SELECT * FROM tb_usuarios WHERE usu_email = '$email'";
        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) > 0) {
            $usuario = mysqli_fetch_assoc($result);

            // Verificar a senha usando password_verify
            if (password_verify($senha, $usuario['usu_senha'])) {
                // Se a senha estiver correta, iniciar a sessão
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usu_login'] = $usuario['usu_login'];
                header("Location: index2.php");
                exit(); // Sempre bom adicionar para garantir que o script não continue
            } else {
                echo "<script>alert('Senha incorreta.');</script>";
            }
        } else {
            echo "<script>alert('E-mail não registrado.');</script>";
        }
    } else {
        echo "<script>alert('Por favor, preencha todos os campos.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="login.php" method="POST">
        <input type="email" name="txtemail" placeholder="E-mail" required><br>
        <input type="password" name="txtsenha" placeholder="Senha" required><br>
        <button type="submit">Login</button>
    </form>
    <p>Não é registrado ainda? <a href="cadastro_usuario.php">Cadastre-se</a></p>
</body>
</html>
