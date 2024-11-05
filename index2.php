<?php
include('db.php');
session_start(); // Inicia a sessão para gerenciar login de usuários
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/estilo.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/carousel.css">
  <link rel="stylesheet" href="css/btn.css">
  <link href="https://fonts.cdnfonts.com/css/glorien-sans-serif" rel="stylesheet">
  <link href="https://fonts.cdnfonts.com/css/there-must-be" rel="stylesheet">
  <link href="https://fonts.cdnfonts.com/css/copyright-violations?styles=35686" rel="stylesheet">
  <link href="https://fonts.cdnfonts.com/css/cinematografica" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <title>Cadastro de Livros e Filmes (Resenha)</title>
</head>

<body class="mainpage">
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
      <a href="listar_filmes.php">Criar Resenha  Filme</a>
      <a href="listar_livros.php">Criar Resenha  Livro</a>
      <a href="listar_resenhas_filme.php">Resenhas Filmes</a>
      <a href="listar_resenhas_livro.php">Resenhas Livros</a>
      </div>
      </div>
      <?php if (isset($_SESSION['usuario_id'])) { ?>
        <!-- Se o usuário estiver logado -->
        <span style="color: #d8d4d5;">Bem-vindo, <?php echo $_SESSION['usu_login']; ?>!</span>
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
  <div class="nome-sit">
    <text>
      RESENHANDO LIFE
    </text>
  </div>

  <div class="container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner">

        <div class="item active">
          <img src="imagens/bilheteria.jpg" alt="" style="width: 700px; height: 500px;">
          <div class="carousel-caption">
            <h3></h3>
            <h4><h4>
          </div>
        </div>

        <div class="item">
          <img src="imagens/livrinhos.jpeg" alt="" style="width: 700px; height: 500px;">
          <div class="carousel-caption">
            <h3></h3>
            <h4><h4>
          </div>
        </div>

        <div class="item">
          <img src="imagens/livrosefilmes.jpg" alt="" style="width: 700px; height: 500px;">
          <div class="carousel-caption">
            <h3></h3>
            <h4><h4>
          </div>
        </div>

      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
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
