-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para conexaolocal
DROP DATABASE IF EXISTS `conexaolocal`;
CREATE DATABASE IF NOT EXISTS `conexaolocal` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `conexaolocal`;

-- Copiando estrutura para tabela conexaolocal.comentario
DROP TABLE IF EXISTS `comentario`;
CREATE TABLE IF NOT EXISTS `comentario` (
  `id_cmt` int NOT NULL AUTO_INCREMENT,
  `comentario` varchar(250) NOT NULL,
  `id_usuario` int NOT NULL,
  `id_evt` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cmt`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_evt` (`id_evt`),
  CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`id_evt`) REFERENCES `evento` (`id_evt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela conexaolocal.comentario: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela conexaolocal.evento
DROP TABLE IF EXISTS `evento`;
CREATE TABLE IF NOT EXISTS `evento` (
  `id_evt` int NOT NULL AUTO_INCREMENT,
  `id_org` int NOT NULL,
  `nome_evt` varchar(250) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  `start_date_event` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `local_evento` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT '0.00',
  `status_evento` enum('Ativo','Cancelado','Encerrado') DEFAULT 'Ativo',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_evt`),
  KEY `id_org` (`id_org`),
  CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`id_org`) REFERENCES `organizador` (`id_org`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela conexaolocal.evento: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela conexaolocal.interacao
DROP TABLE IF EXISTS `interacao`;
CREATE TABLE IF NOT EXISTS `interacao` (
  `id_interacao` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_evt` int NOT NULL,
  `tipo` enum('like','subscribe','favorite') NOT NULL,
  PRIMARY KEY (`id_interacao`),
  UNIQUE KEY `id_usuario` (`id_usuario`,`id_evt`,`tipo`),
  KEY `id_evt` (`id_evt`),
  CONSTRAINT `interacao_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE,
  CONSTRAINT `interacao_ibfk_2` FOREIGN KEY (`id_evt`) REFERENCES `evento` (`id_evt`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela conexaolocal.interacao: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela conexaolocal.organizador
DROP TABLE IF EXISTS `organizador`;
CREATE TABLE IF NOT EXISTS `organizador` (
  `id_org` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `nome_org` varchar(250) NOT NULL,
  `cnpj` int NOT NULL,
  PRIMARY KEY (`id_org`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `organizador_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela conexaolocal.organizador: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela conexaolocal.usuario
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `user_type` enum('Organizador','Usuário') DEFAULT 'Usuário',
  `senha` varchar(250) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela conexaolocal.usuario: ~4 rows (aproximadamente)
INSERT INTO `usuario` (`id_usuario`, `nome`, `username`, `email`, `user_type`, `senha`) VALUES
	(1, 'Catarina Silva', 'catsil', 'catsil@email.com', 'Usuário', '$2y$10$0.0syc8SXq0DTDJviGY3nuatu.dnYPG9MoBRigPcIGmIBi6PR13oS'),
	(2, 'Isaque Newton', 'isaque_n', 'isaque@g.com', 'Organizador', '$2y$10$wCV.H9osDLfz.IqN9A3voekoHEf4boexU9vcVuLqnYffZDSqlPDz6'),
	(3, 'Márcio Lorenzo', 'marcio_lorenzo', 'marcio-araujo73@gasparalmeida.com', 'Usuário', '$2y$10$AnzLj50lyak1OT43gi3NBeNAScjkU5BHn0EZ/2l8xpM8UEHPwn0S2'),
	(4, 'Anna Iris', 'anna_iris', 'annna@g.com', 'Organizador', '$2y$10$jsOWM0ksTnuIph9/kvxHre1m5hAh9C9dSnD5gre39G48t2uQfvqfe');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
