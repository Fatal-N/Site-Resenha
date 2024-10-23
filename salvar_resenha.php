<?php
include('db.php');
session_start();

$item_id = $_POST['item_id'];
$usuario = $_POST['usuario'];
$nota = $_POST['nota'];
$comentario = $_POST['comentario'];

$sql = "INSERT INTO resenhas (item_id, usuario, nota, comentario) VALUES ('$item_id', '$usuario', '$nota', '$comentario')";
mysqli_query($link, $sql);

header("Location: detalhe.php?id=$item_id");
?>
