<?php

require_once('/laragon/www/conexaolocal/api/config.php');


//login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'], $_POST['senha'])) {

    $username = $_POST['username'];
    $senha = $_POST['senha'];

    // Busca o usuário pelo username
    $sql = "SELECT id_usuario, nome, username, email, user_type, senha FROM usuario WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Verifica se a senha bate com o hash armazenado
        if (password_verify($senha, $usuario['senha'])) {
            session_start();
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['username'] = $usuario['username'];
            $_SESSION['user_type'] = $usuario['user_type']; 

            // Redireciona com base no tipo de usuário
            if ($usuario['user_type'] == 'Organizador') {
                header("Location: organizador.php");
                exit;
            } elseif ($usuario['user_type'] == 'Usuário') {
                header("Location: evento.php");
                exit;
            } else {
                
                $_SESSION['error_message'] = "Tipo de usuário desconhecido.";
                header("Location: /laragon/www/conexaolocal/app/login.php"); 
                exit;
            }
        } else {
            // Senha incorreta
            $_SESSION['error_message'] = "Senha incorreta!";
            header("Location: /laragon/www/conexaolocal/app/login.php"); 
            exit;
        }
    } else {
        // Usuário não encontrado
        $_SESSION['error_message'] = "Usuário não encontrado!";
        header("Location: /laragon/www/conexaolocal/app/login.php"); 
        exit;
    }
}
?>

