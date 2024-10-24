<?php
include('db.php');
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php?msg=Para cadastrar um filme, primeiro faça seu login.");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Obtendo os dados do formulário
  $titulo = $_POST['titulo'];
  $diretor = $_POST['diretor'];
  $genero = $_POST['genero']; // Captura o gênero selecionado
  $ano_lancamento = $_POST['ano_lancamento'];
  $descricao = $_POST['descricao'];
  $imagem = $_FILES['imagem']['name'];

  // Caminho para salvar a imagem
  $destino = "uploads/" . basename($imagem);
  move_uploaded_file($_FILES['imagem']['tmp_name'], $destino);

  // Preparar a consulta SQL
  $stmt = $link->prepare("INSERT INTO tb_filmes (titulo, diretor, genero, ano_lancamento, descricao, imagem) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $titulo, $diretor, $genero, $ano_lancamento, $descricao, $imagem);

  // Executar a consulta
  if ($stmt->execute()) {
      header("Location: listar_filmes.php");
      exit(); // Sempre bom adicionar para garantir que o script não continue
  } else {
      echo "Erro ao cadastrar filme: " . $stmt->error;
  }

  // Fechar a declaração
  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/estilocssforms.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/carousel.css">
  <link rel="stylesheet" href="css/btn.css">
  <!-- <link href="https://fonts.cdnfonts.com/css/armstrong-2" rel="stylesheet">
  <link href="https://fonts.cdnfonts.com/css/copyright-violations?styles=35686" rel="stylesheet">
  <link href="https://fonts.cdnfonts.com/css/devinne-swash" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>> -->
    <title>Cadastrar Filme</title>
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
        <span>Bem-vindo, <?php echo $_SESSION['usu_login']; ?>!</span>
        <a href="logout.php">Logout</a>
      <?php } else { ?>
        <a href="cadastro_usuario.php">Cadastre-se</a>
        <a href="login.php">Login</a>
      <?php } ?>
    </div>
    <div class="redesocial">
      <a href="https://facebook.com" class="faceb"><img src="imagens/icons/Facebook.webp" width="30px" height="30px"></a>
      <a href="https://instagram.com" class="insta"><img src="imagens/icons/instagramicon.webp" width="30px" height="30px"></a>
    </div>
</div>
    <div class="container-glob">
        <form class="formulario1" action="cadastro_filme.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="titulo" placeholder="Título" required><br>
            <input type="text" name="diretor" placeholder="Diretor" required><br>
            <label for="genero">Gênero:</label>
            <select name="genero" required>
    <option value="">Selecione o gênero</option>
    <option value="Ação">Ação</option>
<option value="Ação/Aventura">Ação/Aventura</option>
<option value="Aventura">Aventura</option>
<option value="Aventura/Fantasia">Aventura/Fantasia</option>
<option value="Animação">Animação</option>
<option value="Comédia">Comédia</option>
<option value="Comédia Romântica">Comédia Romântica</option>
<option value="Documentário">Documentário</option>
<option value="Drama">Drama</option>
<option value="Drama/Romance">Drama/Romance</option>
<option value="Fantasia">Fantasia</option>
<option value="Ficção Científica">Ficção Científica</option>
<option value="Horror">Horror</option>
<option value="Mistério">Mistério</option>
<option value="Romance">Romance</option>
<option value="Suspense">Suspense</option>
<option value="Terror">Terror</option>
<option value="Thriller">Thriller</option>

</select>
            <label for="ano_lancamento">Ano de Lançamento:</label>
<select name="ano_lancamento" id="ano_lancamento" required>
    <?php
    // Define o intervalo de anos (exemplo: de 1900 até o ano atual)
    $ano_atual = date("Y");
    for ($ano = $ano_atual; $ano >= 1900; $ano--) {
        echo "<option value='$ano'>$ano</option>";
    }
    ?>
</select>
            <textarea name="descricao" placeholder="Descrição" required></textarea><br>
            <input type="file" name="imagem" required><br>
            <button type="submit">Cadastrar Filme</button>
        </form>
    </div>
</body>
<footer class="rodape">
  <main class="map">
    <h1>Mapa do Site</h1>
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

