<?php
require_once('/laragon/www/conexaolocal/api/config.php');
require_once('/laragon/www/conexaolocal/api/logic.php');
require_once('/laragon/www/conexaolocal/api/login.php');


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
            <a href="eventos.php"">Eventos</a>
            <a href="orgent.php">Organizadores</a>      
        </nav>
        <div class="icons">            
            <i class="fas fa-user" id="login-btn"></i>
        </div>
        
    </header>
    <div class="login-form-container">
        <i class="fas fa-times" id="form-close"></i>
        
        <form action="" method="POST">            
            <h3>Login</h3>
            <?php
                if (isset($error)) {
                    foreach ($error as $error) { 
                        echo '<span class="error_msg">' . $errorMessage . '</span>';
                    }
                }
            ?>       
            <input type="text" class="box" name="username" placeholder="Digite seu username">
            <input type="password" class="box" name="senha" placeholder="Digite sua senha">
            <input type="submit" name="login" class="btn" value="Enviar">
            <input type="checkbox" name="enviar" id="remenber">
            <label for="remenber">Lembre-se de mim</label>
            <p>Esqueceu a senha? <a href="#">Clique aqui</a></p>
            <p>Não tem uma conta? <a href="./cadastro.php">Cadastre agora</a></p>
        </form>
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



    <section class="login" id="login">
        <form action="" method="POST">
            <h3>Login</h3>
            <input type="text" name="username" class="box" placeholder="Digite seu username" id="">
            <input type="password" name="senha" class="box" placeholder="Digite sua senha" id="">
            <input type="submit" value="Enviar" class="btn" name="login">
            <input type="checkbox" name="" id="remenber">
            <label for="remenber">Lembre-se de mim</label>
            <p>Esqueceu a senha? <a href="#">Clique aqui</a></p>
            <p>Não tem uma conta? <a href="./cadastro.php">Cadastre agora</a></p>
        </form>   
    </section>
<footer class="footer">
    <a target="_blank" href="https://github.com/RosaCL"><img src="./ressources/img/costureza.png" alt=""></a>
</footer>

    <script src="./ressources/js/script.js"></script>
</body>

</html>