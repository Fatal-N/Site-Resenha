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
 

 -- Tabela de Filmes
 CREATE TABLE tb_filmes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    diretor VARCHAR(255) NOT NULL,
    genero VARCHAR(100) NOT NULL,
    ano_lancamento YEAR NOT NULL,
    descricao TEXT NOT NULL,
    imagem VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de Livros
CREATE TABLE tb_livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    genero VARCHAR(100) NOT NULL,
    data_publicacao YEAR NOT NULL,
    descricao TEXT NOT NULL,
    imagem VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de Resenhas de Filmes
CREATE TABLE tb_resenhas_filmes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    filme_id INT NOT NULL,
    usuario VARCHAR(100) NOT NULL,
    nota INT NOT NULL,
    comentario TEXT NOT NULL,
    data_resenha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES tb_usuarios(id),
    FOREIGN KEY (filme_id) REFERENCES tb_filmes(id)
);

-- Tabela de Resenhas de Livros
CREATE TABLE tb_resenhas_livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    livro_id INT NOT NULL,
    usuario VARCHAR(100) NOT NULL,
    nota INT NOT NULL,
    comentario TEXT NOT NULL,
    data_resenha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES tb_usuarios(id),
    FOREIGN KEY (livro_id) REFERENCES tb_livros(id)
);
