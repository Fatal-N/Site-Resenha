<?php include('db.php'); ?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Filmes</title>
    <link rel="stylesheet" href="css/estilo_filmes.css"> <!-- Link para o CSS separado -->
    <link rel="stylesheet" href="css/estilo.css">
    <!-- <link rel="stylesheet" href="css/estilocssforms.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/btn.css">
    <!-- <link rel="stylesheet" href="css/carousel.css"> -->
</head>
<body class="filmefundo">
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
    <h1>Filmes Cadastrados</h1>
    <div class="filme-container">
        <?php
        $sql_filmes = "SELECT * FROM tb_filmes";
        $result_filmes = mysqli_query($link, $sql_filmes);
        while ($filme = mysqli_fetch_assoc($result_filmes)) {
            echo "<div class='filme-card'>";
            echo "<img src='uploads/{$filme['imagem']}' alt='{$filme['titulo']}' class='filme-imagem' />";
            echo "<div class='filme-titulo'>{$filme['titulo']}</div>";
            echo "<p>Ano de Lançamento: {$filme['ano_lancamento']}</p>";
            echo "<div class='filme-sinopse hidden' id='desc_filme_{$filme['id']}'>{$filme['descricao']}</div>";
            echo "<button class='filme-botao' onclick='toggleDescription(\"desc_filme_{$filme['id']}\")'>Ver Sinopse</button>";
            echo "<button class='filme-botao' onclick='location.href=\"resenha_filme.php?filme_id={$filme['id']}\"'>Fazer Resenha</button>";
            echo "</div>";
        }
        ?>
    </div>

    <script>
function toggleDescription(id) {
    const sinopse = document.getElementById(id);
    if (sinopse.classList.contains('hidden')) {
        sinopse.classList.remove('hidden'); // Remove a classe hidden para mostrar
        sinopse.classList.add('expanded'); // Adiciona a classe expanded para expandir
    } else {
        sinopse.classList.remove('expanded'); // Remove a classe expanded
        sinopse.classList.add('hidden'); // Adiciona a classe hidden para esconder
    }
}
</script>

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


