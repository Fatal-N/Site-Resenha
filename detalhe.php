<?php
session_start();
include('db.php');

$id = $_GET['id'];
$sql = "SELECT * FROM itens WHERE id = $id";
$item = mysqli_fetch_assoc(mysqli_query($link, $sql));

// Buscar as resenhas
$resenhas = mysqli_query($link, "SELECT * FROM resenhas WHERE item_id = $id");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo $item['titulo']; ?></title>
</head>
<body>
    <h1><?php echo $item['titulo']; ?></h1>
    <p>Tipo: <?php echo $item['tipo']; ?></p>
    <p><?php echo $item['descricao']; ?></p>

    <h2>Resenhas</h2>
    <ul>
        <?php while ($resenha = mysqli_fetch_assoc($resenhas)) { ?>
            <li><strong><?php echo $resenha['usuario']; ?>:</strong> <?php echo $resenha['comentario']; ?> (Nota: <?php echo $resenha['nota']; ?>)</li>
        <?php } ?>
    </ul>

    <?php if (isset($_SESSION['usuario_id'])) { ?>
        <h2>Adicionar Resenha</h2>
        <form action="salvar_resenha.php" method="POST">
            <input type="hidden" name="item_id" value="<?php echo $id; ?>">
            <input type="hidden" name="usuario" value="<?php echo $_SESSION['nome_exibicao']; ?>">
            <input type="number" name="nota" placeholder="Nota (1-5)" min="1" max="5" required><br>
            <textarea name="comentario" placeholder="Sua resenha" required></textarea><br>
            <button type="submit">Enviar Resenha</button>
        </form>
    <?php } else { ?>
        <p><a href="login.php">Faça login</a> para adicionar uma resenha.</p>
    <?php } ?>
</body>
</html>
