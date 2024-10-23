CREATE DATABASE resenhas;

USE resenhas;

CREATE TABLE tb_itens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    tipo ENUM('livro', 'filme') NOT NULL,
    autor_diretor VARCHAR(255) NOT NULL,
    ano INT NOT NULL,
    genero VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    imagem VARCHAR(255) NOT NULL,
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tb_usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usu_login VARCHAR(100) NOT NULL,
    usu_email VARCHAR(100) NOT NULL UNIQUE,
    usu_senha VARCHAR(100) NOT NULL
);
CREATE TABLE tb_resenha (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    usuario VARCHAR(100) NOT NULL,
    nota INT NOT NULL,
    comentario TEXT NOT NULL,
    data_resenha DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (item_id) REFERENCES tb_itens(id)
);
