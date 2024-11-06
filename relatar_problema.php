<?php
session_start();
include 'db.php';

$filme_id = $_GET['filme_id']; // Pega o ID do filme

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipo_problema = $_POST['tipo_problema'];
    $comentario = $_POST['comentario'];
    $usuario_id = $_SESSION['usuario_id'];

    // Insira o relato de problema na tabela de problemas (você deve criar essa tabela)
    $sql = "INSERT INTO tb_problemas (filme_id, usuario_id, tipo_problema, comentario) 
            VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $filme_id, $usuario_id, $tipo_problema, $comentario);
    $stmt->execute();
    
    // Enviar notificação ao administrador (você pode usar mail() ou outra função)
}

?>

<form method="POST">
    <label for="tipo_problema">Tipo de Problema:</label>
    <select name="tipo_problema" required>
        <option value="Nome incorreto">Nome incorreto</option>
        <option value="Sinopse incorreta">Sinopse incorreta</option>
        <option value="Imagem incorreta">Imagem incorreta</option>
    </select>
    <label for="comentario">Comentário:</label>
    <textarea name="comentario" required></textarea>
    <button type="submit">Enviar</button>
</form>
