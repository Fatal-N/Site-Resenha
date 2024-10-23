<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Livros</title>
</head>
<body>
    <h1>Livros Cadastrados</h1>
    <ul>
        <?php
        $sql = "SELECT * FROM tb_itens WHERE tipo = 'livro'";
        $result = mysqli_query($link, $sql);
        while ($item = mysqli_fetch_assoc($result)) {
            echo "<li><a href='detalhe.php?id={$item['id']}'>{$item['titulo']}</a></li>";
        }
        ?>
    </ul>
</body>
</html>
