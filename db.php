<?php
// Conexão com o banco de dados MySQL
$servidor = 'localhost';
$banco = 'resenhas';
$usuario = 'root'; // O XAMPP usa 'root' por padrão
$senha = ''; // A senha é vazia por padrão

$link = mysqli_connect($servidor, $usuario, $senha, $banco);
