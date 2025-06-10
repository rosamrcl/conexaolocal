<?php
session_start(); 
require_once('/laragon/www/conexaolocal/api/config.php');

// Verifica se o usuário está logado e é um organizador
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit();
}

if (!isset($_SESSION['id_org'])) {
    header('Location: organizador.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['evento_cadastro'])) {
    // Verifica se todos os campos foram preenchidos
    $camposObrigatorios = [
        'nome_evt', 'descricao', 'start_date_event',
        'local_evento', 'endereco', 'cidade', 'status_evento'
    ];
    
    $dadosFaltantes = [];
    foreach ($camposObrigatorios as $campo) {
        if (empty($_POST[$campo])) {
            $dadosFaltantes[] = $campo;
        }
    }

    if (!empty($dadosFaltantes)) {
        $_SESSION['erro'] = "Os seguintes campos são obrigatórios: " . implode(', ', $dadosFaltantes);
        header('Location: /conexaolocal/app/organizador_evento.php');
        exit();
    }

    try {
        // Validação do organizador
        $stmt = $pdo->prepare("SELECT id_org FROM organizador WHERE id_org = ? AND id_usuario = ? LIMIT 1");
        $stmt->execute([$_SESSION['id_org'], $_SESSION['id_usuario']]);
        $organizador = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$organizador) {
            $_SESSION['erro'] = "Organizador não encontrado ou não vinculado a este usuário.";
            header('Location: /conexaolocal/app/organizador.php');
            exit();
        }
        
        // Formatação das datas para DATETIME
        $start_date = date('Y-m-d H:i:s', strtotime($_POST['start_date_event']));
        $end_date = !empty($_POST['end_date']) ? date('Y-m-d H:i:s', strtotime($_POST['end_date'])) : null;
        
        // Tratamento do preço
        $preco = !empty($_POST['preco']) ? floatval($_POST['preco']) : 0.00;
        
        // Inserção do evento
        $stmt = $pdo->prepare("INSERT INTO evento (
            nome_evt, descricao, start_date_event, end_date, local_evento,
            endereco, cidade, preco, status_evento, id_org
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $sucesso = $stmt->execute([
            htmlspecialchars($_POST['nome_evt']),
            htmlspecialchars($_POST['descricao']),
            $start_date,
            $end_date,
            htmlspecialchars($_POST['local_evento']),
            htmlspecialchars($_POST['endereco']),
            htmlspecialchars($_POST['cidade']),
            $preco,
            $_POST['status_evento'],
            $_SESSION['id_org']
        ]);

        if ($sucesso) {
            $_SESSION['sucesso'] = "Evento cadastrado com sucesso!";
            header('Location: /conexaolocal/app/evento.php');
            exit();
        } else {
            throw new Exception("Falha ao executar a inserção no banco de dados");
        }
        
    } catch (PDOException $e) {
        $_SESSION['erro'] = "Erro no banco de dados: " . $e->getMessage();
        header('Location: /conexaolocal/app/organizador_evento.php');
        exit();
    } catch (Exception $e) {
        $_SESSION['erro'] = $e->getMessage();
        header('Location: /conexaolocal/app/organizador_evento.php');
        exit();
    }
} else {
    header('Location: /conexaolocal/app/organizador_evento.php');
    exit();
}