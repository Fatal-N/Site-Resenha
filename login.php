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
    <link rel="stylesheet" href="css/estilocssforms.css">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.cdnfonts.com/css/armstrong-2" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/copyright-violations?styles=35686" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/devinne-swash" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="containermenu" width="1054px">
        <div class="mymenu">
            <a href="index2.php">Início</a>
            <a href="cadastro_livro.php">Cadastrar Livro</a>
            <a href="cadastro_filme.php">Cadastrar Filme</a>
            <a href="listar_livros.php">Ver Livros Cadastrados</a>
            <a href="listar_filmes.php">Ver Filmes Cadastrados</a>
            <?php if (isset($_SESSION['usuario_id'])) { ?>
                <!-- Se o usuário estiver logado -->
                <span>Bem-vindo, <?php echo $_SESSION['usu_login']; ?>!</span>
                <a href="logout.php">Logout</a>
            <?php } else { ?>
                <!-- Se o usuário não estiver logado -->
                <a href="cadastro_usuario.php">Cadastre-se</a>
                <a href="login.php">Login</a>
            <?php } ?>
        </div>
        <div class="redesocial">
            <a href="https://facebook.com" class="faceb"><img src="imagens/icons/Facebook.webp" width="30px" height="30px"></a>
            <a href="https://instagram.com" class="insta"><img src="imagens/icons/instagramicon.webp" width="30px" height="30px"></a>
        </div>
    </div>

    <div class="container-global">
        <form class="formulario" action="login.php" method="POST">
            <h1>Login</h1>
            <input type="email" name="txtemail" placeholder="E-mail" required><br>
            <input type="password" name="txtsenha" placeholder="Senha" required><br>
            <button type="submit">Login</button>
            <p>Não é registrado ainda? <a href="cadastro_usuario.php">Cadastre-se</a></p>

            <?php
            if (isset($_GET['msg'])) {
                echo '<p>' . $_GET['msg'] . '</p>';
            }
            ?>
        </form>
    </div>
</body>
</html>
