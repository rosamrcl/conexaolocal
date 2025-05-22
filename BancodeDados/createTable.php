<?php
include('/laragon/www/conexaolocal/api/config.php');

// Cria tabela usuario
$pdo->exec("CREATE TABLE IF NOT EXISTS usuario (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(250) NOT NULL,
    username VARCHAR(250) UNIQUE NOT NULL,
    email VARCHAR(250) UNIQUE NOT NULL,
    senha VARCHAR(250) NOT NULL
)");

// Cria tabela interacao (não depende de nenhuma outra)
$pdo->exec("CREATE TABLE IF NOT EXISTS interacao (
    id_interacao INT PRIMARY KEY AUTO_INCREMENT
)");

// Cria tabela organizador SEM referência a evento ainda
$pdo->exec("CREATE TABLE IF NOT EXISTS organizador (
    id_org INT PRIMARY KEY AUTO_INCREMENT,
    nome_org VARCHAR(250) NOT NULL,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
)");

// Cria tabela evento (agora com referencia correta)
$pdo->exec("CREATE TABLE IF NOT EXISTS evento (
    id_evt INT PRIMARY KEY AUTO_INCREMENT,
    nome_evt VARCHAR(250) NOT NULL,
    id_org INT NOT NULL,
    id_interacao INT NOT NULL,
    FOREIGN KEY (id_org) REFERENCES organizador(id_org),
    FOREIGN KEY (id_interacao) REFERENCES interacao(id_interacao)
)");



// Cria tabela comentario
$pdo->exec("CREATE TABLE IF NOT EXISTS comentario (
    id_cmt INT PRIMARY KEY AUTO_INCREMENT,
    comentario VARCHAR(250) NOT NULL,
    id_usuario INT NOT NULL,
    id_org INT NOT NULL,
    id_evt INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_org) REFERENCES organizador(id_org),
    FOREIGN KEY (id_evt) REFERENCES evento(id_evt)
)");
?>
