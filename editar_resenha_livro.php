<?php
include('db.php');
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php?msg=Antes de editar a resenha, faça login.");
    exit();
}

// Verifica se o livro_id e resenha_id foram passados na URL
if (!isset($_GET['livro_id']) || !isset($_GET['resenha_id'])) {
    echo "Livro ou resenha não encontrada.";
    exit();
}

$livro_id = $_GET['livro_id'];
$resenha_id = $_GET['resenha_id'];

// Busca informações do livro
$stmt = $link->prepare("SELECT titulo, imagem FROM tb_livros WHERE id = ?");
$stmt->bind_param("i", $livro_id);
$stmt->execute();
$result = $stmt->get_result();
$livro = $result->fetch_assoc();

if (!$livro) {
    echo "Livro não encontrado.";
    exit();
}

// Busca a resenha existente
$stmt = $link->prepare("SELECT nota, comentario FROM tb_resenhas_livros WHERE id = ?");
$stmt->bind_param("i", $resenha_id);
$stmt->execute();
$result = $stmt->get_result();
$resenha = $result->fetch_assoc();

if (!$resenha) {
    echo "Resenha não encontrada.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtendo os dados da resenha
    $nota = $_POST['nota'];
    $comentario = $_POST['comentario'];

    // Preparar a consulta SQL
    $stmt = $link->prepare("UPDATE tb_resenhas_livros SET nota = ?, comentario = ? WHERE id = ?");
    $stmt->bind_param("isi", $nota, $comentario, $resenha_id);

    // Executar a consulta
    if ($stmt->execute()) {
        header("Location: listar_resenhas_livro.php?livro_id=$livro_id"); // Redireciona para a lista de resenhas após a edição
        exit();
    } else {
        echo "Erro ao atualizar resenha: " . $stmt->error;
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
    <link rel="stylesheet" href="css/cssstars.css">
    <link href="https://fonts.cdnfonts.com/css/glorien-sans-serif" rel="stylesheet">
    <link rel="stylesheet" href="css/estilocssforms.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/carousel.css">
    
    <title>Editar Resenha do Livro</title>
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
  </div>
    <div class="container-glob">
        <form class="formulario1" action="editar_resenha_livro.php?livro_id=<?php echo $livro_id; ?>&resenha_id=<?php echo $resenha_id; ?>" method="POST">
        <h2>Editar Resenha do Livro: <?php echo $livro['titulo']; ?></h2>
        <div class="film-card">
            <img class="film-image" src="uploads/<?php echo $livro['imagem']; ?>" alt="<?php echo $livro['titulo']; ?>" style="width:200px; height:auto;">
        </div>
        <div class="estrelas" id="estrelas" data-nota="<?php echo $resenha['nota']; ?>">
            <span class="estrela" data-valor="1">&#9733;</span> <!-- Estrela cheia -->
            <span class="estrela" data-valor="2">&#9733;</span>
            <span class="estrela" data-valor="3">&#9733;</span>
            <span class="estrela" data-valor="4">&#9733;</span>
            <span class="estrela" data-valor="5">&#9733;</span>
        </div>
        <input type="hidden" name="nota" id="nota" value="<?php echo $resenha['nota']; ?>">
        <textarea name="comentario" placeholder="Sua avaliação" required><?php echo $resenha['comentario']; ?></textarea><br>
        <button type="submit">Atualizar Resenha</button>
        <script>
            const estrelas = document.querySelectorAll('.estrela');
            const inputNota = document.getElementById('nota');
            const notaAtual = parseInt(document.getElementById('estrelas').getAttribute('data-nota'));

            estrelas.forEach(estrela => {
                estrela.addEventListener('click', () => {
                    const valor = parseInt(estrela.getAttribute('data-valor'));

                    // Atualiza as estrelas com base na estrela clicada
                    estrelas.forEach((item, index) => {
                        if (index < valor) {
                            item.classList.add('amarela'); // Estrela amarela
                            item.classList.remove('branca'); // Remove a classe branca
                        } else {
                            item.classList.remove('amarela'); // Remove a classe amarela
                            item.classList.add('branca'); // Adiciona a classe branca
                        }
                    });

                    // Atualiza o valor da nota
                    inputNota.value = valor;
                });
            });

            // Definir as estrelas de acordo com a nota atual
            estrelas.forEach((item, index) => {
                if (index < notaAtual) {
                    item.classList.add('amarela'); // Estrela amarela
                    item.classList.remove('branca'); // Remove a classe branca
                } else {
                    item.classList.remove('amarela'); // Remove a classe amarela
                    item.classList.add('branca'); // Adiciona a classe branca
                }
            });
        </script>
        </form>
    </div>
</body>
<footer class="rodape">
    <main class="map">
        <h1>Mapa do Site</h1>
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
