<?php
include('db.php');

// Dados do formulário
$titulo = $_POST['titulo'];
$autor_diretor = $_POST['autor_diretor'];
$ano = $_POST['ano'];
$genero = $_POST['genero'];
$tipo = $_POST['tipo'];
$descricao = $_POST['descricao'];

// Upload da imagem
$imagem = $_FILES['imagem']['name'];
$destino_imagem = "uploads/" . basename($imagem);
move_uploaded_file($_FILES['imagem']['tmp_name'], $destino_imagem);

// Inserir no banco de dados
$sql = "INSERT INTO itens (titulo, tipo, autor_diretor, ano, genero, descricao, imagem)
        VALUES ('$titulo', '$tipo', '$autor_diretor', '$ano', '$genero', '$descricao', '$imagem')";
mysqli_query($link, $sql);

// Redireciona para a listagem de livros ou filmes, conforme o tipo
if ($tipo == 'livro') {
    header("Location: listar_livros.php");
} else {
    header("Location: listar_filmes.php");
}
?>
