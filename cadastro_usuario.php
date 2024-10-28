<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_exibicao = $_POST['nome_exibicao'];
    $email = $_POST['txtemail'];
    $senha = password_hash($_POST['txtsenha'], PASSWORD_DEFAULT); // Hash da senha

    // Verificar se o email já existe
    $sql = "SELECT * FROM tb_usuarios WHERE usu_email = '$email'";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "Este e-mail já está registrado.";
    } else {
        $sql = "INSERT INTO tb_usuarios (usu_login, usu_email, usu_senha) VALUES ('$nome_exibicao', '$email', '$senha')";
        mysqli_query($link, $sql);
        header("Location: login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
</head>

<body class="cadastro-fundo">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/estilocssforms.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="css/carousel.css"> -->
  <link rel="stylesheet" href="css/btn.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.cdnfonts.com/css/armstrong-2" rel="stylesheet">
  <link href="https://fonts.cdnfonts.com/css/copyright-violations?styles=35686" rel="stylesheet">
  <link href="https://fonts.cdnfonts.com/css/devinne-swash" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <div class="containermenu" width="1054px">
    <div class="mymenu">
      <a href="index2.php" class="faceb"><img src="imagens/icons/homepag.png" width="40px" height="40px"></a>
      <a href="cadastro_livro.php">Cadastrar Livro</a>
      <a href="cadastro_filme.php">Cadastrar Filme</a>
      <a href="listar_livros.php">Livros Cadastrados</a>
      <a href="listar_filmes.php">Filmes Cadastrados</a>
      <div class="dropdown">
      <button class="dropbtn">Resenhas 🠋</button>
      <div class="dropdown-content">
      <a href="resenha_filme.php">Criar Resenha  Filme</a>
      <a href="resenha_livro.php">Criar Resenha  Livro</a>
      <a href="listar_resenhas_filme.php">Resenhas Filmes</a>
      <a href="listar_resenhas_livro.php">Resenhas Livros</a>
      </div>
      </div>
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
            <a href="https://facebook.com" class="faceb"><img src="imagens/icons/Facebook.webp" width="29px" height="29px"></a>
            <a href="https://instagram.com" class="insta"><img src="imagens/icons/instagramicon.png" width="34px" height="34px"></a>
        </div>
  </div>
    <div class="container-global">
        <form class="formulario" action="cadastro_usuario.php" method="POST">
            <label>NOME</label>
            <input type="text" name="nome_exibicao" placeholder="Insira seu login" required>
            <br>
            <label>EMAIL</label>
            <input type="email" name="txtemail" placeholder="Digite seu email" required>
            <br>
            <label>SENHA</label>
            <input type="password" name="txtsenha" placeholder="Crie uma senha" required>
            <br>
            <button type="submit">Criar Conta</button>
            </form>
    </div>
</body>
<footer class="rodape">
  <main class="map">
    <?php if (!isset($_SESSION['usuario_id'])) { ?>
    <!-- Exibir "Cadastre-se" e "Efetue Login" se o usuário não estiver logado -->
    <a href="cadastro_usuario.php">Cadastre-se</a>
    <a href="login.php">Efetue Login</a>
<?php } else { ?>
    <!-- Exibir apenas o "Logout" se o usuário estiver logado -->
    <a href="logout.php">Logout</a>
<?php } ?>
    <p class="right"><b>Todos os direitos reservados &copy; 2024</b></p>
  </main>
</footer>
</html>