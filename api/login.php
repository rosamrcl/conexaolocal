<?php
require_once('/laragon/www/conexaolocal/api/config.php');


//login
session_start();
if (isset($_POST['enviar'])) {
    $name = $_POST['nome'];
    $username = $_POST['username']; 
    $email = $_POST['email'];
    $senha = ($_POST['senha']);
    $csenha = ($_POST['csenha']);
    $user_type = $_POST['user_type'];

    
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE username = :username AND senha = :senha");
    $stmt->execute(['username' => $username, 'senha' => $senha]);
    $row = $stmt->fetch(); // Pega a primeira linha de resultado

    if ($row) { // Se uma linha foi encontrada
        if ($row['user_type'] == 'organizador') {
            $_SESSION['admin_name'] = $row['nome'];
            header('Location: orgent.php');
            exit(); 
        } elseif ($row['user_type'] == 'usuario') {
            $_SESSION['user_name'] = $row['nome'];
            header('Location: eventos.php');
            exit(); 
        }
    } else {
        $error[] = 'Username ou senha incorreta';
    }
}

?>

?>