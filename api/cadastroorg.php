<?php
require_once('/laragon/www/conexaolocal/api/config.php');
require_once('/laragon/www/conexaolocal/api/login.php');


<<<<<<< HEAD
if ($_SERVER ['REQUEST_METHOD'] ==='POST' && isset($_POST['adicionar_org'])) {
    if (!empty ($_POST ['nome_org'])
    && !empty ($_POST['cnpj'])
    && !empty ($_POST['id_usuario'])){
        $stmt = $pdo->prepare("INSERT INTO organizador ( nome_org, cnpj,id_usuario) VALUES (?, ?, ?)");        
        $stmt->execute([$_POST['nome_org'],
        $_POST ['cnpj'],
        $_POST ['id_usuario']]);
        header('Location: organizador_evento.php');
        exit();   
        
        } 
    } 
=======
if (isset($_POST['adicionar_org'])) {
    //Verificar se o id_usuario está na sessão
    if (!isset($_SESSION['id_usuario'])) {
        header('Location: organizador_evento.php');
        exit();
    }
>>>>>>> be7e176e012d5cbc52cab26d83671dfef7217631


<<<<<<< HEAD
=======
    $errors = []; 
    
    // 1. Verificar se o usuário existe 
    $stmt_select = $pdo->prepare("SELECT * FROM usuario WHERE id_usuario = :id_usuario");
    $stmt_select->bindParam(':id_usuario', $id_usuario);
    $stmt_select->execute();

    if ($stmt_select->rowCount() == 0) {
        $errors[] = "Usuário não encontrado. Não é possível cadastrar a organização.";
    }

    if(empty($errors)){
        $stmt = $pdo->prepare("INSERT INTO organizador (nome_org, cnpj, id_usuario) VALUES (:nome_org, :cnpj, :id_usuario)");
        $stmt->bindParam(':nome_org', $nome_org);
        $stmt->bindParam(':cnpj', $cnpj);
        $stmt->bindParam(':id_usuario', $id_usuario);

        if ($stmt->execute()) {            
            exit();
        } else {
            $errors[] = "Erro ao cadastrar a organização. Por favor, tente novamente.";
        }
    }
    
    // Se chegou aqui, houve erros
    foreach ($errors as $error) {
        echo '<span class="error-msg">' . $error . '</span>';
    }
}
>>>>>>> be7e176e012d5cbc52cab26d83671dfef7217631
?>