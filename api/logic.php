<?php
require_once('/laragon/www/conexaolocal/api/config.php');

if (isset($_POST['adicionar'])) {
    $user_type = $_POST['user_type'];
}
if (isset($_POST['adicionar'])) {
    $nome = $_POST['nome'];
    $username = $_POST['username'];
    $email = $_POST['email'];    
    $senha = $_POST['senha'];
    $csenha = $_POST['csenha'];
    $user_type = $_POST['user_type']; 

    

    $errors = [];
    // 1. Verificar se o usuário já existe
    $stmt_select = $pdo->prepare("SELECT * FROM usuario WHERE username = :username OR email = :email");
    $stmt_select->bindParam(':username', $username);
    $stmt_select->bindParam(':email', $email);
    $stmt_select->execute();

    if ($stmt_select->rowCount() > 0) {
        $errors[] = "Nome de usuário ou e-mail já existe!";
    }

    // 2. Verificar se as senhas coincidem
    if ($senha !== $csenha) {
        $errors[] = "As senhas não são iguais!";
    }

    $hashedPassword = password_hash($senha, PASSWORD_DEFAULT);

    // 3. Se não houver erros, inserir o novo usuário
    if (empty($errors)) {  
        $stmt = $pdo->prepare("INSERT INTO usuario (nome, username, email, senha, user_type) VALUES (:nome, :username, :email, :senha, :user_type)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':user_type', $user_type);
        $stmt->bindParam(':senha', $hashedPassword);

        if ($stmt->execute()) {
            header('Location: login.php');
            exit();
        } else {
            $errors[] = "Erro ao registrar o usuário. Tente novamente.";
        }
    }

    // Se houver erros, exiba-os 
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo '<span class="error-msg">' . $error . '</span>';
        }
    }
}



?>




