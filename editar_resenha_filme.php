<?php
include('db.php');
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php?msg=Antes de fazer a resenha, faça login.");
    exit();
}

// Verifica se o resenha_id foi passado na URL
if (!isset($_GET['resenha_id'])) {
    echo "Resenha não encontrada.";
    exit();
}

$resenha_id = $_GET['resenha_id'];

// Recupera a resenha para edição
$stmt = $link->prepare("SELECT rf.*, f.titulo, f.imagem 
                        FROM tb_resenhas_filmes rf
                        JOIN tb_filmes f ON rf.filme_id = f.id
                        WHERE rf.id = ? AND rf.usuario_id = ?");
$stmt->bind_param("ii", $resenha_id, $_SESSION['usuario_id']);
$stmt->execute();
$resenha_result = $stmt->get_result();
$resenha = $resenha_result->fetch_assoc();

if (!$resenha) {
    echo "Resenha não encontrada ou você não tem permissão para editá-la.";
    exit();
}

// Processa o envio do formulário de edição
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nota = isset($_POST['nota']) ? (int)$_POST['nota'] : 0;
    $comentario = $_POST['comentario'];

    // Atualiza a resenha no banco de dados
    $stmt = $link->prepare("UPDATE tb_resenhas_filmes SET nota = ?, comentario = ? WHERE id = ? AND usuario_id = ?");
    $stmt->bind_param("isii", $nota, $comentario, $resenha_id, $_SESSION['usuario_id']);
    
    if ($stmt->execute()) {
        header("Location: listar_resenhas_filme.php?msg=Resenha atualizada com sucesso.");
        exit();
    } else {
        echo "Erro ao atualizar a resenha. Tente novamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/estilo.css">
  <link rel="stylesheet" href="css/btn.css">
  <link href="https://fonts.cdnfonts.com/css/glorien-sans-serif" rel="stylesheet">
  <link href="https://fonts.cdnfonts.com/css/code-new-roman-2" rel="stylesheet">
  <link href="https://fonts.cdnfonts.com/css/isidora-soft-alt" rel="stylesheet">
  <link href="https://fonts.cdnfonts.com/css/abyzou" rel="stylesheet">
  <link rel="stylesheet" href="css/cssstars.css">
  <link rel="stylesheet" href="css/estilocssforms.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <title>Cadastrar Filmes</title>
</head>
<body class="filmefundow">
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
          <a href="listar_filmes.php">Criar Resenha Filme</a>
          <a href="listar_livros.php">Criar Resenha Livro</a>
          <a href="listar_resenhas_filme.php">Resenhas Filmes</a>
          <a href="listar_resenhas_livro.php">Resenhas Livros</a>
        </div>
      </div>
      <?php if (isset($_SESSION['usuario_id'])) { ?>
        <span style="color: #d8d4d5;">Bem-vindo, <?php echo $_SESSION['usu_login']; ?>!</span>
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
    <div class="container-glob">
        <form class="formulario1" method="post" action="">
            <h2 id="nominho2"><?php echo htmlspecialchars($resenha['titulo']); ?></h2>
            <div class="film-card">
                <img class="film-image" src="uploads/<?php echo htmlspecialchars($resenha['imagem']); ?>" alt="<?php echo htmlspecialchars($resenha['titulo']); ?>" style="width:200px; height:auto;">
            </div>
            <div class="estrelas" id="estrelas" data-nota="0">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <span class="estrela <?php echo ($resenha['nota'] >= $i) ? 'amarela' : 'branca'; ?>" data-valor="<?php echo $i; ?>">&#9733;</span>
                <?php endfor; ?>
            </div>
            <input type="hidden" name="nota" id="nota" value="<?php echo htmlspecialchars($resenha['nota']); ?>">
            <textarea name="comentario" placeholder="Sua avaliação" required><?php echo htmlspecialchars($resenha['comentario']); ?></textarea><br>
            <button type="submit">Salvar Alterações</button>
            <a href="listar_resenhas_filme.php" class="botao-voltar">Cancelar</a>
        </form>

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
    </div>
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
