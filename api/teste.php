<?php
//adicione um arquivo auth.php para gerenciar a autenticação:
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

function requireGuest() {
    if (isLoggedIn()) {
        header('Location: index.php');
        exit();
    }
}

// login

require_once 'auth.php';
requireGuest();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Processar login
    $username = $_POST['username'];
    $senha = $_POST['senha'];
    
    // Verificar credenciais no banco
    $stmt = $pdo->prepare("SELECT id_usuario, senha FROM usuario WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['user_id'] = $user['id_usuario'];
        header('Location: index.php');
        exit();
    } else {
        $error = "Credenciais inválidas";
    }
}
//Formulário de login HTML aqui -->

//register
require_once 'auth.php';
requireGuest();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Processar registro
    $nome = $_POST['nome'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    
    try {
        $stmt = $pdo->prepare("INSERT INTO usuario (nome, username, email, senha) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $username, $email, $senha]);
        
        header('Location: login.php');
        exit();
    } catch (PDOException $e) {
        $error = "Erro ao registrar: " . $e->getMessage();
    }
}

//Proteger as páginas do site
require_once 'auth.php';
requireLogin();

// Restante do código da página

//logout

session_start();
session_destroy();
header('Location: login.php');
exit();

//menu navegação
//php if (isLoggedIn()): 
    !-- Menu para usuários logados --
    a href="perfil.php">Meu Perfil/a
    a href="eventos.php">Eventos</a>
    a href="logout.php">Sair</a>
//php else: 
    !-- Menu para visitantes --
a href="login.php">Login</a>
    a href="register.php">Registrar/a
//php endif; 

//proteção 

// No código que processa o formulário de criar evento
requireLogin();

// Verificar se o usuário é um organizador
$stmt = $pdo->prepare("SELECT id_org FROM organizador WHERE id_usuario = ?");
$stmt->execute([$_SESSION['user_id']]);
$org = $stmt->fetch();

if (!$org) {
    die("Apenas organizadores podem criar eventos");
}

// Processar criação do evento...


?>