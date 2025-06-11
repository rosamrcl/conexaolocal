<?php
session_start(); 
require_once('/laragon/www/conexaolocal/api/config.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit();
}


$errors =[];

// Verifica se o usuário já é um organizador ANTES de processar o POST

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar_org'])) {
    // Verifica se todos os campos foram preenchidos
    if (!empty($_POST['nome_org'])){
        $errors[] = "Nome da organização é obrigatório";
    }
    
    if (!empty($_POST['cnpj'])){
        $errors[] = "CNPJ é obrigatório";
    }
    
    $stmt = $pdo->prepare("SELECT id_org FROM organizador WHERE id_usuario = ? LIMIT 1");
    $stmt->execute([$_SESSION['id_usuario']]);

    if($stmt->fetch()){
        $errors[]= "Você já é um organizador";
    }
    
    if (empty($errors)){
        $stmt = $pdo->prepare("INSERT INTO organizador (nome_org, cnpj, id_usuario) VALUES (?, ?, ?)");        
        $stmt->execute([
            $_POST['nome_org'],
            $_POST['cnpj'],
            $_SESSION['id_usuario']]);            

            header('Location: \conexaolocal\app\organizador_evento.php');
            exit();   
    }
    
}

?>


