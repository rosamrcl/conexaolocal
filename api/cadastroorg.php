<?php
require_once('/laragon/www/conexaolocal/api/config.php');


session_start();

if (isset($_POST['adicionar_org'])) {
    //Verificar se o id_usuario está na sessão
    if (isset($_SESSION['id_usuario'])) {
        $id_usuario = $_SESSION['id_usuario'];
    } else {
        header('Location: login.php'); 
        exit();
    }

    $nome_org = $_POST['nome_org'];
    $cnpj = $_POST['cnpj'];

    $error = [];
    // 1. Verificar se o usuário existe 
    $stmt_select = $pdo->prepare("SELECT * FROM usuario WHERE id_usuario = :id_usuario");
    $stmt_select->bindParam(':id_usuario', $id_usuario);
    $stmt_select->execute();

    if ($stmt_select->rowCount() == 0) {
        $error[] = "Usuário não encontrado. Não é possível cadastrar a organização.";
    }

    if(empty($errors)){
        $stmt = $pdo->prepare("INSERT INTO organizador (nome_org, cnpj, id_usuario) VALUES (:nome_org, :cnpj, :id_usuario)");
        $stmt->bindParam(':nome_org', $nome_org);
        $stmt->bindParam(':cnpj', $cnpj);
        $stmt->bindParam(':id_usuario', $id_usuario);

        if ($stmt->execute()) {
            header('Location: organizador_evento.php');
            exit();
        } else {
            echo "Erro ao cadastrar a organização. Por favor, tente novamente.";
        }
    } else {
        // Exibir os erros para o usuário
            foreach ($errors as $error) {
            echo '<span class="error-msg">' . $error . '</span>';
        }
    }
}
?>