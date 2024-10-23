<?php
// session_start(); // Inicia a sessão para gerenciar login de usuários
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
  <link href="https://fonts.cdnfonts.com/css/armstrong-2" rel="stylesheet">
  <link href="https://fonts.cdnfonts.com/css/copyright-violations?styles=35686" rel="stylesheet">
  <link href="https://fonts.cdnfonts.com/css/devinne-swash" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <title>Cadastro de Livros e Filmes (Resenha)</title>
</head>

<body class="mainpage">
  <div class="containermenu" width="1054px">
    <div class="mymenu">
      <a href="index2.php">Início</a>
      <a href="cadastro_livro.php">Cadastrar Livro</a>
      <a href="cadastro_filme.php">Cadastrar Filme</a>
      <a href="listar_livros.php">Ver Livros Cadastrados</a>
      <a href="listar_filmes.php">Ver Filmes Cadastrados</a>
      <?php if (isset($_SESSION['usuario_id'])) { ?>
        <!-- Se o usuário estiver logado -->
        <span>Bem-vindo, <?php echo $_SESSION['nome_exibicao']; ?>!</span>
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
  <div class="nome-jogo">
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
          <img src="imagens/livros.jfif" alt="" style="width: 700px; height: 500px;">
          <div class="carousel-caption">
            <h3></h3>
            <h4><h4>
          </div>
        </div>

        <div class="item">
          <img src="imagens/cinema-stuff-red-cloth.jpg" alt="" style="width: 700px; height: 500px;">
          <div class="carousel-caption">
            <h3></h3>
            <h4><h4>
          </div>
        </div>

        <div class="item">
          <img src="imagens/livros-filmes.jpg" alt="" style="width: 700px; height: 500px;">
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
    <h1>Mapa do Site</h1>
    <a href="cadastro_usuario.php">Cadastre-se</a>
    <a href="login.php">Efetue Login</a>
    <p class="right"><b>Todos os direitos reservados &copy; 2024</b></p>
  </main>
</footer>
</html>
