<?php
session_start();
require_once('/laragon/www/conexaolocal/api/config.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit();
}

$errors = [];

// Verifica se o usuário já é um organizador
$stmt = $pdo->prepare("SELECT id_org FROM organizador WHERE id_usuario = ? LIMIT 1");
$stmt->execute([$_SESSION['id_usuario']]);
$organizador = $stmt->fetch();

if($organizador) {
    $_SESSION['id_org'] = $organizador['id_org'];
} else {
    // Se não for organizador, cadastra como um
    $stmt = $pdo->prepare("INSERT INTO organizador (id_usuario) VALUES (?)");
    if($stmt->execute([$_SESSION['id_usuario']])) {
        $_SESSION['id_org'] = $pdo->lastInsertId();
    } else {
        $errors[] = "Erro ao cadastrar como organizador";
    }
}

// Processa o formulário de evento
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['evento_cadastro'])) {
    // Validação dos campos
    $requiredFields = [
        'nome_evt' => "Nome do evento é obrigatório",
        'descricao' => "Descrição é obrigatória",
        'start_date_event' => "Data de início é obrigatória",
        'end_date' => "Data de término é obrigatória",
        'local_evento' => "Local é obrigatório",
        'endereco' => "Endereço é obrigatório",
        'cidade' => "Cidade é obrigatória",
        'preco' => "Preço é obrigatório",
        'status_evento' => "Status é obrigatório"
    ];
    
    foreach ($requiredFields as $field => $message) {
        if (empty($_POST[$field])) {
            $errors[] = $message;
        }
    }
    
    if (empty($errors) && isset($_SESSION['id_org'])) {
        try {
            $stmt = $pdo->prepare("INSERT INTO evento 
                (id_org, nome_evt, descricao, start_date_event, end_date, 
                local_evento, endereco, cidade, preco, status_evento) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                
            $success = $stmt->execute([
                $_SESSION['id_org'],
                $_POST['nome_evt'],
                $_POST['descricao'],
                $_POST['start_date_event'],
                $_POST['end_date'],
                $_POST['local_evento'],
                $_POST['endereco'],
                $_POST['cidade'],
                $_POST['preco'],
                $_POST['status_evento']
            ]);
            
            if($success) {
                header('Location: /conexaolocal/app/evento.php');
                exit();
            } else {
                $errors[] = "Erro ao cadastrar evento";
            }
        } catch(PDOException $e) {
            $errors[] = "Erro no banco de dados: " . $e->getMessage();
        }
    }
}
