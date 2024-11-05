<?php include('db.php'); 
session_start();?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resenhas de Livros</title>
    <link rel="stylesheet" href="css/estilo_livros.css">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/btn.css">
    <link rel="stylesheet" href="css/cssstars.css">
    <link href="https://fonts.cdnfonts.com/css/glorien-sans-serif" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/manjari-2" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/code-new-roman-2" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/isidora-soft-alt" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/abyzou" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/resenhas.css">
</head>
<body class="livrofundo">
    <div class="containermenu">
        <div class="mymenu">
            <a href="index2.php" class="faceb"><img src="imagens/icons/homepag.png" width="40px" height="40px"></a>
            <a href="cadastro_livro.php">Cadastrar Livro</a>
            <a href="cadastro_filme.php">Cadastrar Filme</a>
            <a href="listar_livros.php">Livros Cadastrados</a>
            <a href="listar_filmes.php">Filmes Cadastrados</a>
            <div class="dropdown">
                <button class="dropbtn">Resenhas 🠋</button>
                <div class="dropdown-content">
                <a href="listar_filmes.php">Criar Resenha  Filme</a>
                <a href="listar_livros.php">Criar Resenha  Livro</a>
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

    <h1 id="nominho">Essa página é dedicada às avaliações dos usuários referente aos livros. Sinta-se a vontade para criar uma resenha!</h1>
    <div class="resenha-container">
        <?php
        $sql_resenhas = "SELECT rl.*, u.usu_login, l.titulo, l.imagem 
                         FROM tb_resenhas_livros rl
                         JOIN tb_usuarios u ON rl.usuario_id = u.id
                         JOIN tb_livros l ON rl.livro_id = l.id";
        $result_resenhas = mysqli_query($link, $sql_resenhas);

        while ($resenha = mysqli_fetch_assoc($result_resenhas)) {
            echo "<div class='resenha-card'>";
            echo "<img src='uploads/{$resenha['imagem']}' alt='{$resenha['titulo']}' class='resenha-imagem' />";
            echo "<div class='resenha-info'>";
            echo "<h2 id='nominho3'>{$resenha['titulo']}</h2>";
            echo "<p class='listarstyl'><strong>Autor:</strong> {$resenha['usu_login']}</p>";
            echo "<p class='listarstyl'><strong>Nota:</strong> " . str_repeat("⭐", $resenha['nota']) . "</p>";
            echo "<p class='listarstyl'><strong>Comentário:</strong> {$resenha['comentario']}</p>";

            // Exibir ícone de edição apenas para o autor da resenha
            if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_id'] == $resenha['usuario_id']) {
                echo "<div class='editar-resenha'>";
                echo "<a href='editar_resenha_livro.php?resenha_id={$resenha['id']}' title='Editar Resenha'>";
                echo "<span class='glyphicon glyphicon-pencil'></span> <span class='editar-texto'>Editar Resenha</span>";
                echo "</a>";
                echo "</div>";
            }

            echo "</div>";
            echo "</div>";
        }
        ?>
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
