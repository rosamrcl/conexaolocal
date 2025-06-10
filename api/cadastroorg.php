<?php

session_start(); 
require_once('/laragon/www/conexaolocal/api/config.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar_org'])) {
    // Verifica se todos os campos foram preenchidos
    if (!empty($_POST['nome_org']) && !empty($_POST['cnpj'])) {
        
        // Verifica se o usuário já é um organizador
        $stmt = $pdo->prepare("SELECT id_org FROM organizador WHERE id_usuario = ?");
        $stmt->execute([$_SESSION['id_usuario']]);
        $organizadorExistente = $stmt->fetch();
        
        if ($organizadorExistente) {
            // Usuário já é organizador, mostra mensagem de erro
            $_SESSION['erro'] = "Você já está cadastrado como organizador.";
            header('Location: \conexaolocal\app\organizador_evento.php');
            exit();
        }

        
        // Insere o novo organizador
        try {
            $stmt = $pdo->prepare("INSERT INTO organizador (nome_org, cnpj, id_usuario) VALUES (?, ?, ?)");        
            $stmt->execute([
                $_POST['nome_org'],
                $_POST['cnpj'],
                $_SESSION['id_usuario'] 
            ]);
            
            $_SESSION['sucesso'] = "Cadastro como organizador realizado com sucesso!";
            header('Location: \conexaolocal\app\organizador_evento.php');
            exit();   
        } catch (PDOException $e) {
            // Tratamento de erro do banco de dados
            $_SESSION['erro'] = "Erro ao cadastrar organizador: " . $e->getMessage();
            header('Location: organizador.php');
            exit();
        }
    } else {
        $_SESSION['erro'] = "Por favor, preencha todos os campos obrigatórios.";
        header('Location: organizador.php');
        exit();
    }
}


?>


