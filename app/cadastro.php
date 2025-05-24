<?php
include ("/laragon/www/conexaolocal/api/config.php");
include ("/laragon/www/conexaolocal/api/logic.php");

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header class="header" id="header">
        <a href="index.php" class="logo"><img src="./ressources/img/logo.png" alt=""></a>
        <nav class="navbar">
            <a href="./index.php">Home</a>
            <a href="./cadastro.php">Cadastro</a>
            <a href="#eventos">Eventos</a>
            <a href="#organizadores">Organizadores</a>
            <a href="#reviews">Comentários</a>
            
            
        </nav>
            <div class="icons">               
                <div id="login-btn" class="fas fa-user"></div>
            </div>
            <div class="login-form-container">
                    <div id="close-login-btn" class="fas fa-times"></div>
                    <form method="get">
                        <h3>Faça seu login</h3>
                        <span>Usuário</span>
                        <input type="text" name="username" class="box" placeholder="Seu username" id="username">
                        <span>Senha</span>
                        <input type="password" name="" class="box" placeholder="Sua senha" id="">
                        <div class="checkbox">
                            <input type="checkbox" name="" id="lembre-se">
                            <label for="lembre-se">Lembre-se de mim</label>
                        </div>
                        <input type="submit" value="Enviar" class="btn">
                        <p>Esqueceu a senha? <a href="#">Click aqui</a></p>
                        <p>Não tem uma conta? <a href="./cadastro.php">Crie uma conta</a></p>
                    </form>
            </div>
    </header>
    <section class="cadastro" id="cadastro">
        <div class="cadastro">
            <form action="" method="post">
                <h3>Faça seu cadastro</h3>
                    <input type="text" name="" class="box" placeholder="Seu nome" id="">
                    <input type="text" name="" class="box" placeholder="Seu username" id="">
                    <input type="email" name="" class="box" placeholder="Seu email" id="">              
                    <input type="password" name="" class="box" placeholder="Sua senha" id="">
                    <input type="submit" name="adicionar" value="Cadastrar" class="btn">
            </form>
        </div>
    </section>


<script src="./ressources/js/script.js"></script>
</body>
</html>