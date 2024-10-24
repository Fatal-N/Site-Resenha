<?php include('db.php'); ?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Filmes</title>
    <link rel="stylesheet" href="css/estilo_filmes.css"> <!-- Link para o CSS separado -->
    <link rel="stylesheet" href="css/estilo.css">
    <!-- <link rel="stylesheet" href="css/estilocssforms.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="css/carousel.css">
  <link rel="stylesheet" href="css/btn.css"> -->
</head>
<body>
    <h1>Filmes Cadastrados</h1>
    <div class="filme-container">
        <?php
        $sql_filmes = "SELECT * FROM tb_filmes";
        $result_filmes = mysqli_query($link, $sql_filmes);
        while ($filme = mysqli_fetch_assoc($result_filmes)) {
            echo "<div class='filme-card'>";
            echo "<img src='uploads/{$filme['imagem']}' alt='{$filme['titulo']}' class='filme-imagem' />";
            echo "<div class='filme-titulo'>{$filme['titulo']}</div>";
            echo "<p>Ano de Lançamento: {$filme['ano_lancamento']}</p>";
            echo "<div class='filme-sinopse hidden' id='desc_filme_{$filme['id']}'>{$filme['descricao']}</div>";
            echo "<button class='filme-botao' onclick='toggleDescription(\"desc_filme_{$filme['id']}\")'>Ver Sinopse</button>";
            echo "<button class='filme-botao' onclick='location.href=\"resenha.php?tipo=filme&id={$filme['id']}\"'>Fazer Resenha</button>";
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


