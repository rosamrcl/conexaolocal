<?php
include ('/laragon/www/conexaolocal/api/config.php');

session_start();

// Verifica se é um submit de registro
if (isset($_POST['adicionar']) && isset($_POST['nome'])) {
    // Lógica de registro
    $nome = $_POST['nome'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];
    $senha = md5($_POST['senha']); 
    $csenha = md5($_POST['csenha']);
    
    // ... resto do código de registro
} 
// Verifica se é um submit de login
elseif (isset($_POST['submit'])) {
    // Lógica de login
    $username = $_POST['username'];
    $senha = md5($_POST['senha']);
    
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE username = :username AND senha = :senha");
    $stmt->execute(['username' => $username, 'senha' => $senha]);
    $row = $stmt->fetch();
    
    if ($row) {
        if ($row['user_type'] == 'org') {
            $_SESSION['org_name'] = $row['nome'];
            header('Location: orgent.php');
            exit(); 
        } elseif ($row['user_type'] == 'user') {
            $_SESSION['user_name'] = $row['nome'];
            header('Location: eventos.php');
            exit();
        }
    } else {
        $error[] = 'Username ou senha incorreta';
    }
}

?>