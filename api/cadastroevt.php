<?php

session_start(); 
require_once('/laragon/www/conexaolocal/api/config.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['evento_cadastro'])) {

    // Verifica se todos os campos foram preenchidos
    if (
        !empty($_POST['nome_evt']) &&     
        !empty($_POST['descricao']) &&
        !empty($_POST['start_date_event']) &&
        !empty($_POST['end_date']) &&
        !empty($_POST['local_evento']) &&
        !empty($_POST['endereco']) &&
        !empty($_POST['cidade']) &&
        !empty($_POST['preco']) &&
        !empty($_POST['status_evento'])
    ) {
        
        try {
            // Recupera o ID do organizador
            $stmt = $pdo->prepare("SELECT id_org FROM organizador WHERE id_usuario = ?");
            $stmt->execute([$_SESSION['id_usuario']]);
            $organizador = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$organizador) {
                $_SESSION['erro'] = "Usuário não é um organizador válido.";
                header('Location: /conexaolocal/app/organizador_evento.php');
                exit();
            }

            $id_org = $organizador['id_org'];
            $_SESSION['id_org'] = $id_org;

            // Insere o novo evento
            $stmt = $pdo->prepare("INSERT INTO evento (
                nome_evt, descricao, start_date_event, end_date, local_evento,
                endereco, cidade, preco, status_evento, id_usuario, id_org
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->execute([
                $_POST['nome_evt'],
                $_POST['descricao'],
                $_POST['start_date_event'],
                $_POST['end_date'],
                $_POST['local_evento'],
                $_POST['endereco'],
                $_POST['cidade'],
                $_POST['preco'],
                $_POST['status_evento'],
                $_SESSION['id_usuario'],
                $id_org
            ]);

            $_SESSION['sucesso'] = "Evento cadastrado com sucesso!";
            header('Location: /conexaolocal/app/evento.php');
            exit();

        } catch (PDOException $e) {
            $_SESSION['erro'] = "Erro ao cadastrar evento: " . $e->getMessage();
            header('Location: /conexaolocal/app/organizador_evento.php');
            exit();
        }

    } else {
        $_SESSION['erro'] = "Por favor, preencha todos os campos obrigatórios.";
        header('Location: /conexaolocal/app/organizador_evento.php');
        exit();
    }
}

?>
