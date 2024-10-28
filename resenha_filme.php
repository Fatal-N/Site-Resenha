<?php
include('db.php');
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php?msg=Antes de fazer a resenha, faça login.");
    exit();
}

// Verifica se o filme_id foi passado na URL
if (!isset($_GET['filme_id'])) {
    echo "Filme não encontrado.";
    exit();
}

$filme_id = $_GET['filme_id'];

// Busca informações do filme
$stmt = $link->prepare("SELECT titulo, imagem FROM tb_filmes WHERE id = ?");
$stmt->bind_param("i", $filme_id);
$stmt->execute();
$result = $stmt->get_result();
$filme = $result->fetch_assoc();

if (!$filme) {
    echo "Filme não encontrado.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtendo os dados da resenha
    $usuario_id = $_SESSION['usuario_id'];
    $usuario = $_SESSION['usu_login'];
    $nota = $_POST['nota'];
    $comentario = $_POST['comentario'];

    // Preparar a consulta SQL
    $stmt = $link->prepare("INSERT INTO tb_resenhas_filmes (usuario_id, filme_id, usuario, nota, comentario) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $usuario_id, $filme_id, $usuario, $nota, $comentario);
    // Executar a consulta
    if ($stmt->execute()) {
        header("Location: listar_filmes.php"); // Redireciona para a lista de filmes após a resenha
        exit();
    } else {
        echo "Erro ao cadastrar resenha: " . $stmt->error;
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
    <link rel="stylesheet" href="css/estilocssforms.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/carousel.css">
    
    <title>Resenha do Filme</title>
</head>
<body>
<div class="containermenu">
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
</div>
    <div class="container-glob">
        <form class="formulario1" action="resenha_filme.php?filme_id=<?php echo $filme_id; ?>" method="POST">
        <h2>Resenha do Filme: <?php echo $filme['titulo']; ?></h2>
        <div class = "film-card">
        <img class="film-image" src="uploads/<?php echo $filme['imagem']; ?>" alt="<?php echo $filme['titulo']; ?>"style="width:200px; height:auto;">
        </div>
        <div class="estrelas" id="estrelas" data-nota="0">
    <span class="estrela" data-valor="1">&#9733;</span> <!-- Estrela cheia -->
    <span class="estrela" data-valor="2">&#9733;</span>
    <span class="estrela" data-valor="3">&#9733;</span>
    <span class="estrela" data-valor="4">&#9733;</span>
    <span class="estrela" data-valor="5">&#9733;</span>
</div>
<input type="hidden" name="nota" id="nota" value="0">
            <textarea name="comentario" placeholder="Sua avaliação" required></textarea><br>
            <button type="submit">Enviar Resenha</button>
            <script>
    const estrelas = document.querySelectorAll('.estrela');
    const inputNota = document.getElementById('nota');
    
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
<?php
