<?php include('db.php'); 
session_start();?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Livros</title>
    <link rel="stylesheet" href="css/estilo_livros.css"> <!-- Link para o CSS separado -->
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/btn.css">
    <link href="https://fonts.cdnfonts.com/css/glorien-sans-serif" rel="stylesheet">

</head>
<body class="livrofundo">
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
      <a href="listar_resenhas_filme.php">Criar Resenha  Filme</a>
      <a href="listar_resenhas_livro.php">Criar Resenha  Livro</a>
      <a href="listar_resenhas_filme.php">Resenhas Filmes</a>
      <a href="listar_resenhas_livro.php">Resenhas Livros</a>
      </div>
      </div>
      <?php if (isset($_SESSION['usuario_id'])) { ?>
        <span>Bem-vindo, <?php echo $_SESSION['usu_login']; ?>!</span>
        <a href="logout.php">Logout</a>
      <?php } else { ?>
        <a href="cadastro_usuario.php">Cadastre-se</a>
        <a href="login.php">Login</a>
      <?php } ?>
  </div>
  <div class="redesocial">
            <a href="https://facebook.com" class="faceb"><img src="imagens/icons/Facebook.webp" width="29px" height="29px"></a>
            <a href="https://instagram.com" class="insta"><img src="imagens/icons/instagramicon.png" width="34px" height="34px"></a>
        </div>
  </div>
    <h1 class="h1">Livros Cadastrados</h1>
    <div class="livro-container">
        <?php
        $sql_livros = "SELECT * FROM tb_livros";
        $result_livros = mysqli_query($link, $sql_livros);

        // Verificar se a consulta retornou resultados
        if (mysqli_num_rows($result_livros) > 0) {
            while ($livro = mysqli_fetch_assoc($result_livros)) {
                echo "<div class='livro-card'>";
                echo "<img src='uploads/{$livro['imagem']}' alt='{$livro['titulo']}' class='livro-imagem' />";
                echo "<div class='livro-titulo'>{$livro['titulo']}</div>";
                echo "<p>Data de Publicação: {$livro['data_publicacao']}</p>";
                echo "<div class='livro-sinopse hidden' id='desc_livro_{$livro['id']}'>{$livro['descricao']}</div>";
                echo "<button class='livro-botao' onclick='toggleDescription(\"desc_livro_{$livro['id']}\")'>Ver Sinopse</button>";
                echo "<button class='livro-botao' onclick='location.href=\"resenha_livro.php?livro_id={$livro['id']}\"'>Fazer Resenha</button>";
                echo "</div>";
            }
        } else {
            echo "<p>Nenhum livro cadastrado.</p>";
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
        <a href="cadastro_usuario.php">Cadastre-se</a>
        <a href="login.php">Efetue Login</a>
    <?php } else { ?>
        <a href="logout.php">Logout</a>
    <?php } ?>
    <p class="right"><b>Todos os direitos reservados &copy; 2024</b></p>
  </main>
</footer>
</html>
