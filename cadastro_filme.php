<?php
include('db.php');
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $diretor = $_POST['diretor'];
    $genero = $_POST['genero'];
    $descricao = $_POST['descricao'];
    $imagem = $_FILES['imagem']['name'];
    $ano_lancamento = $_POST['ano_lancamento']; // Novo campo para o ano de lançamento
    
    // Caminho para salvar a imagem
    $destino = "uploads/" . basename($imagem);
    move_uploaded_file($_FILES['imagem']['tmp_name'], $destino);

    $sql = "INSERT INTO itens (titulo, autor, genero, descricao, tipo, imagem, ano, data_cadastro) VALUES ('$titulo', '$diretor', '$genero', '$descricao', 'filme', '$imagem', '$ano_lancamento', NOW())";
    mysqli_query($link, $sql);
    header("Location: listar_filmes.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/estilocssforms.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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
            <input type="text" name="genero" placeholder="Gênero" required><br>
            <label>Ano de Lançamento: </label>
            <input type="date" name="ano_lancamento" required><br> <!-- Campo para o ano de lançamento como um calendário -->
            <textarea name="descricao" placeholder="Descrição" required></textarea><br>
            <input type="file" name="imagem" required><br>
            <button type="submit">Cadastrar Filme</button>
        </form>
    </div>
</body>
</html>
