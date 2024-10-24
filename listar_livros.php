<?php include('db.php'); ?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Livros</title>
    <link rel="stylesheet" href="css/estilo_livros.css"> <!-- Ajuste o caminho se necessário -->
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <h1>Livros Cadastrados</h1>
    <div class="container-livros">
        <?php
        $sql_livros = "SELECT * FROM tb_livros"; // Certifique-se de que a tabela existe
        $result_livros = mysqli_query($link, $sql_livros);
        while ($livro = mysqli_fetch_assoc($result_livros)) {
            echo "<div class='livro-item'>";
            echo "<h3 class='livro-titulo'>{$livro['titulo']}</h3>";
            echo "<img class='livro-imagem' src='uploads/{$livro['imagem']}' alt='{$livro['titulo']}' />";
            echo "<p>Ano de Publicação: {$livro['ano_publicacao']}</p>";
            echo "<div class='livro-descricao hidden' id='desc_livro_{$livro['id']}'>{$livro['descricao']}</div>";
            echo "<button class='livro-botao' onclick='toggleDescription(\"desc_livro_{$livro['id']}\")'>Ver Sinopse</button>";
            echo "<button class='livro-botao' onclick='location.href=\"resenha.php?tipo=livro&id={$livro['id']}\"'>Fazer Resenha</button>";
            echo "</div>";
        }
        ?>
    </div>

    <script>
        function toggleDescription(id) {
            var desc = document.getElementById(id);
            desc.classList.toggle('hidden');
        }
    </script>
</body>
</html>
