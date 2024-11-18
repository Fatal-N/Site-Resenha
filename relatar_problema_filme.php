<?php
// Inclui a conexão com o banco
include 'conexao.php';

// Verifica se o usuário está logado
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $filme_id = $_POST['filme_id'];
    $usuario_id = $_SESSION['usuario_id'];
    $tipo_problema = $_POST['tipo_problema'];
    $comentario = $_POST['comentario'];

    // Insere o problema no banco de dados
    $stmt = $link->prepare("INSERT INTO tb_problemas_filmes (filme_id, usuario_id, tipo_problema, comentario) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $filme_id, $usuario_id, $tipo_problema, $comentario);

    if ($stmt->execute()) {
        echo "Problema relatado com sucesso.";
    } else {
        echo "Erro ao relatar o problema.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Relatar Problema</title>
</head>
<body>
    <form action="relatar_problema_filme.php" method="POST">
        <input type="hidden" name="filme_id" value="<?php echo $_GET['filme_id']; ?>">
        <label for="tipo_problema">Tipo de Problema:</label>
        <select name="tipo_problema" required>
            <option value="Nome incorreto">Nome incorreto</option>
            <option value="Erro na sinopse">Erro na sinopse</option>
            <option value="Imagem inadequada">Imagem inadequada</option>
            <!-- Outras opções -->
        </select>
        <label for="comentario">Comentário:</label>
        <textarea name="comentario" required></textarea>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
