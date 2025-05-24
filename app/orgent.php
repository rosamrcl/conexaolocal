<?php
include("/laragon/www/conexaolocal/api/config.php");
include("/laragon/www/conexaolocal/api/logic.php");

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
    <link rel="stylesheet" href="./ressources/css/evento_org.css">
    <link rel="stylesheet" href="./ressources/css/eventointercoment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header class="header" id="header">
        <a href="index.php" class="logo"><img src="./ressources/img/logo.png" alt=""></a>
        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="cadastro.php">Cadastro</a>
            <a href="#eventos">Eventos</a>
            <a href="orgent.php">Organizadores</a>



        </nav>
        <div class="icons">
            <div id="login-btn" class="fas fa-user"></div>
        </div>
        <div class="login-form-container">
            <div id="close-login-btn" class="fas fa-times"></div>
            <form action="">
                <h3>Faça seu login</h3>
                <span>Usuário</span>
                <input type="text" name="" class="box" placeholder="Seu username" id="">
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
    <section class="organizadores" id="organizadores">
        <form action="" method="post">
            <h3>Cadastre organizador</h3>
            <input type="text" name="" class="box" placeholder="Username" id="">
            <input type="text" name="" class="box" placeholder="Nome do organizador" id="">
            <input type="submit" value="Cadastrar" class="btn">
        </form>
        <form action="" method="post">
            <h3>Cadastre seu evento</h3>

            
            <input type="text" name="" class="box" placeholder="Organizador" id="">
            <input type="text" name="" class="box" placeholder="Nome do evento" id="">
            <input type="text" name="" class="box" placeholder="Descrição" id="">
            <input type="datetime" name="" class="box" placeholder="Inicio do evento" id="">
            <input type="datetime" name="" class="box" placeholder="Fim do evento" id="">
            <input type="datetime" name="" id="">
            <input type="text" name="" class="box" placeholder="Local do evento" id="">
            <input type="text" name="" class="box" placeholder="Endereço do evento" id="">
            <input type="text" name="" class="box" placeholder="Cidade do evento" id="">
            <input type="number" name="" class="box" placeholder="Preço do evento" id="">
            <input type="text" name="" class="box" placeholder="Status do evento" id="">
            

            <input type="submit" value="Cadastrar" class="btn" name="adicionar_evento">
        </form>
    </section>



    <script src="./ressources/js/script.js"></script>
</body>

</html>