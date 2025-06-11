<?php
session_start();
require_once('/laragon/www/conexaolocal/api/config.php');
require_once('/laragon/www/conexaolocal/api/login.php');
require_once('/laragon/www/conexaolocal/api/cadastroevt.php');

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexão Local</title>
    <link rel="stylesheet" href="./ressources/css/style.css">
    <link rel="stylesheet" href="./ressources/css/header.css">
    <link rel="stylesheet" href="./ressources/css/cadastro.css">
    <link rel="stylesheet" href="./ressources/css/home.css">
    <link rel="stylesheet" href="./ressources/css/login.css">
    <link rel="stylesheet" href="./ressources/css/evento_org.css">
    <link rel="stylesheet" href="./ressources/css/eventointercoment.css">
    <link rel="stylesheet" href="./ressources/css/media.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header class="header">
        <div id="menu-bar" class="fas fa-bars"></div>
        <a target="_blank" href="index.php" class="logo"><img src="./ressources/img/logo.png" alt=""></a>
        <nav class="navbar">
            <a href="login.php">Home</a>
            <a href="cadastro.php">Cadastro</a>
            <a href="evento.php"">Eventos</a>      
        </nav>
        <h2>Bem-Vindo, <span><?= htmlspecialchars($_SESSION['username'] ?? '') ?></span></h2>
        <a href="/api/logout.php">Sair</a>
        
    </header>
    <div class="login-form-container">
        <i class="fas fa-times" id="form-close"></i>
    </div>

    <section class="home" id="home">        
        <img src="./ressources/img/logo.png" alt="">
        <div class="imagens">
            <figure>
                <img src="./ressources/img/image01.png" alt="">
            </figure>
            <figure>
                <img src="./ressources/img/image02.png" alt="">
            </figure>
            <figure>
                <img src="./ressources/img/image03.png" alt="">
            </figure>
            <figure>
                <img src="./ressources/img/image04.png" alt="">
            </figure>
            <figure>
                <img src="./ressources/img/image05.png" alt="">
            </figure>
            <figure>
                <img src="./ressources/img/image06.png" alt="">
            </figure>
        </div>
    </section>
    <section class="organizadores">
        <form class="box" method="POST">
            <h3>Cadastre seu evento</h3>
            
            <input type="text" name="nome_evt" class="box" placeholder="Nome do evento" 
                value="<?= htmlspecialchars($dados['nome_evt'] ?? '') ?>" required>
            
            <input type="text" name="descricao" class="box" placeholder="Descrição" 
                value="<?= htmlspecialchars($dados['descricao'] ?? '') ?>" required>
            
            <label>Data de Início</label>
            <input type="date" name="start_date_event" class="box" 
                value="<?= htmlspecialchars($dados['start_date_event'] ?? '') ?>" required>
            
            <label>Data de Término</label>
            <input type="date" name="end_date" class="box" 
                value="<?= htmlspecialchars($dados['end_date'] ?? '') ?>" required>
            
            <input type="text" name="local_evento" class="box" placeholder="Local do evento" 
                value="<?= htmlspecialchars($dados['local_evento'] ?? '') ?>" required>
            
            <input type="text" name="endereco" class="box" placeholder="Endereço" 
                value="<?= htmlspecialchars($dados['endereco'] ?? '') ?>" required>
            
            <input type="text" name="cidade" class="box" placeholder="Cidade" 
                value="<?= htmlspecialchars($dados['cidade'] ?? '') ?>" required>
            
            <input type="number" name="preco" step="0.01" class="box" placeholder="Preço" 
                value="<?= htmlspecialchars($dados['preco'] ?? '') ?>" required>
            
            <select name="status_evento" class="box" required>
                <option value="Ativo" <?= ($dados['status_evento'] ?? '') === 'Ativo' ? 'selected' : '' ?>>Ativo</option>
                <option value="Cancelado" <?= ($dados['status_evento'] ?? '') === 'Cancelado' ? 'selected' : '' ?>>Cancelado</option>
                <option value="Encerrado" <?= ($dados['status_evento'] ?? '') === 'Encerrado' ? 'selected' : '' ?>>Encerrado</option>
            </select>
            
            <input type="submit" value="Enviar" class="btn" name="evento_cadastro">
        </form>
    </section>
    </section>


<footer class="footer">
    <a target="_blank" href="https://github.com/RosaCL"><img src="./ressources/img/costureza.png" alt=""></a>
</footer>

    <script src="./ressources/js/script.js"></script>
</body>

</html>