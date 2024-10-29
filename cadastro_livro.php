<?php
include('db.php');
session_start();

//exibe mensagem se tentar cadastrar e não estiver logado
if (!isset($_SESSION['usuario_id'])) {
  header("Location: login.php?msg=Para cadastrar um livro, primeiro faça seu login.");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Obtendo os dados do formulário
  $titulo = $_POST['titulo'];
  $autor = $_POST['autor'];
  $genero = $_POST['genero'];
  $ano_publicacao = $_POST['ano_publi'];
  $descricao = $_POST['descricao'];
  $imagem = $_FILES['imagem']['name'];

  // Caminho para salvar a imagem
  $destino = "uploads/" . basename($imagem);
  move_uploaded_file($_FILES['imagem']['tmp_name'], $destino);

  // Preparar a consulta SQL
  $stmt = $link->prepare("INSERT INTO tb_livros (titulo, autor, genero, data_publicacao, descricao, imagem) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $titulo, $autor, $genero, $ano_publicacao, $descricao, $imagem);

  // Executar a consulta
  if ($stmt->execute()) {
    header("Location: listar_livros.php");
    exit(); // Sempre bom adicionar para garantir que o script não continue
  } else {
    echo "Erro ao cadastrar livro: " . $stmt->error;
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
  <link href="https://fonts.cdnfonts.com/css/glorien-sans-serif" rel="stylesheet">
  <link rel="stylesheet" href="css/carousel.css">
  <link rel="stylesheet" href="css/btn.css">
  <title>Cadastrar Livro</title>
</head>

<body>
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
  <div class="container-glob">
    <form class="formulario1" action="cadastro_livro.php" method="POST" enctype="multipart/form-data">
      <input type="text" name="titulo" placeholder="Título" required><br>
      <input type="text" name="autor" placeholder="Autor" required><br>
      <label for="genero">Gênero:</label>
            <select name="genero" required>
    <option value="">Selecione o gênero</option>
        <<option value="Ação">Ação</option>
          <option value="Aventura">Aventura</option>
          <option value="Autoajuda">Autoajuda</option>
          <option value="Biografia">Biografia</option>
          <option value="Comédia">Comédia</option>
          <option value="Comédia Romântica">Comédia Romântica</option>
          <option value="Contos">Contos</option>
          <option value="Crônicas">Crônicas</option>
          <option value="Educação">Educação</option>
          <option value="Ensaios">Ensaios</option>
          <option value="Fantasia">Fantasia</option>
          <option value="Ficção Científica">Ficção Científica</option>
          <option value="Graphic Novel">Graphic Novel</option>
          <option value="Guia">Guia</option>
          <option value="Horror">Horror</option>
          <option value="Infantil">Infantil</option>
          <option value="Literatura Clássica">Literatura Clássica</option>
          <option value="Literatura LGBT">Literatura LGBT</option>
          <option value="Mistério">Mistério</option>
          <option value="Material Acadêmico">Material Acadêmico</option>
          <option value="Poesia">Poesia</option>
          <option value="Religião">Religião</option>
          <option value="Romance">Romance</option>
          <option value="Romance Histórico">Romance Histórico</option>
          <option value="Romance Jovem Adulto">Romance Jovem Adulto</option>
          <option value="Romance Policial">Romance Policial</option>
          <option value="Suspense">Suspense</option>
          <option value="Terror">Terror</option>
      </select>
      <label for="ano_publi">Publicado em:</label>
      <select name="ano_publi" id="ano_publi" required>
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
      <button type="submit">Cadastrar Livro</button>
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