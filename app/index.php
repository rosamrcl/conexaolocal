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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header class="header" id="header">
        <a href="index.php" class="logo"><img src="./ressources/img/logo.png" alt=""></a>
            <div class="icons">               
                <div id="login-btn" class="fas fa-user"></div>
            </div>
            <nav class="navbar">
                <a href="#home">Home</a>
                <a href="#featured">Destaque</a>
                <a href="#arrivals">Em breve</a>
                <a href="#reviews">Comentários</a>
                <a href="#blogs">Blogs</a>
                
            </nav>
    </header>
<main>
    <div class="login-form-container">
            <div id="close-login-btn" class="fas fa-times"></div>
            <form action="">
                <h3>Faça seu login</h3>
                <span>Usuário</span>
                <input type="email" name="" class="box" placeholder="seu email" id="">
                <span>Senha</span>
                <input type="password" name="" class="box" placeholder="sua senha" id="">
                <div class="checkbox">
                    <input type="checkbox" name="" id="lembre-se">
                    <label for="lembre-se">Lembre-se de mim</label>
                </div>
                <input type="submit" value="Enviar" class="btn">
                <p>Esqueceu a senha? <a href="#">Click aqui</a></p>
                <p>Não tem uma conta? <a href="#">Crie uma conta</a></p>
            </form>
        </div>
</main>
</body>
</html>