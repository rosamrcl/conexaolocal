<?php
session_start(); 
require_once(__DIR__ . '/../api/config.php');

//Verifica se o usuário está logado 
if (!isset($_SESSION['id_org'])) {
    header('Location: login.php');
    exit();
}

$errors =[];


// $stmt = $pdo->prepare("SELECT id_org FROM organizador WHERE id_usuario = ? LIMIT 1");
// $stmt->execute([$_SESSION['id_org']]);



if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['evento_cadastro'])){
    $obrigatorio= ['nome_evt', 'descricao', 'start_date_event', 'end_date', 'local_evento', 'endereco', 'cidade', 'preco', 'status_evento'];
    $dados = [];
    foreach ($camposObrigatorios as $campo) {
        if (empty($_POST[$campo])) {
            $erro = "Todos os campos são obrigatórios!";
            break;
        }
        $dados[$campo] = trim($_POST[$campo]);
    }
    if (empty ($erros)){
        $dataInicio = DateTime::createFromFormat('Y-m-d', $dados['start_date_event']);
        $dataFim = DateTime::createFromFormat('Y-m-d', $dados['end_date']);
    }
    if (empty($errors)){
        $stmt=$pdo ->prepare("INSERT INTO evento (id_org, nome_evt, descricao, start_date_event, end_date, local_evento, endereco, cidade, preco, status_evento) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_SESSION['id_org'],
            $dados['nome_evt'],
            $dados['descricao'],
            $dados['start_date_event'] . ' 00:00:00', // Convertendo para DATETIME
            $dados['end_date'] . ' 23:59:59',
            $dados['local_evento'],
            $dados['endereco'],
            $dados['cidade'], (float) $dados['preco'],
            $dados['status_evento']
        ]);

        header('Location: conexaolocal/app/evento.php');
        exit;

    }
}


