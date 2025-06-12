<?php
session_start();
require_once('/laragon/www/conexaolocal/api/config.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit();
}

// Busca os eventos
$stmt = $pdo->prepare("SELECT * FROM evento ORDER BY start_date_event ASC");
$stmt->execute();
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verifica se o usuário já curtiu/seguir os eventos
$curtidas = [];
$seguindo = [];
if (isset($_SESSION['id_usuario'])) {
    $stmt = $pdo->prepare("SELECT id_evt, tipo FROM interacao WHERE id_usuario = ?");
    $stmt->execute([$_SESSION['id_usuario']]);
    $interacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($interacoes as $interacao) {
        if ($interacao['tipo'] == 'Curtir') {
            $curtidas[$interacao['id_evt']] = true;
        } elseif ($interacao['tipo'] == 'Seguir') {
            $seguindo[$interacao['id_evt']] = true;
        }
    }
}

// Processa as interações (curtir/seguir/comentar)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_evt']) && isset($_SESSION['id_usuario'])) {
        $id_evt = $_POST['id_evt'];
        $id_usuario = $_SESSION['id_usuario'];
        
        // Processa curtir
        if (isset($_POST['curtir'])) {
            $tipo = 'Curtir';
            
            try {
                $stmt = $pdo->prepare("INSERT INTO interacao (id_usuario, id_evt, tipo) VALUES (?, ?, ?)");
                $stmt->execute([$id_usuario, $id_evt, $tipo]);
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit();
            } catch (PDOException $e) {
                if ($e->getCode() != '23000') { // Ignora erros de duplicação
                    die("Erro ao curtir: " . $e->getMessage());
                }
            }
        } 
        // Processa seguir
        elseif (isset($_POST['seguir'])) {
            $tipo = 'Seguir';
            
            try {
                $stmt = $pdo->prepare("INSERT INTO interacao (id_usuario, id_evt, tipo) VALUES (?, ?, ?)");
                $stmt->execute([$id_usuario, $id_evt, $tipo]);
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit();
            } catch (PDOException $e) {
                if ($e->getCode() != '23000') {
                    die("Erro ao seguir: " . $e->getMessage());
                }
            }
        } 
        // Processa comentário
        elseif (isset($_POST['comentario']) && !empty(trim($_POST['comentario']))) {
            $comentario = trim($_POST['comentario']);
            
            try {
                $stmt = $pdo->prepare("INSERT INTO comentario (id_usuario, id_evt, comentario) VALUES (?, ?, ?)");
                $stmt->execute([$id_usuario, $id_evt, $comentario]);
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit();
            } catch (PDOException $e) {
                die("Erro ao adicionar comentário: " . $e->getMessage());
            }
        }
        
        // Redireciona se nenhum dos casos acima foi atendido
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Busca comentários para cada evento
$comentariosPorEvento = [];
if (!empty($eventos)) {
    $idsEventos = array_column($eventos, 'id_evt');
    $placeholders = implode(',', array_fill(0, count($idsEventos), '?'));
    
    $stmt = $pdo->prepare("
        SELECT c.*, u.nome 
        FROM comentario c
        JOIN usuario u ON c.id_usuario = u.id_usuario
        WHERE c.id_evt IN ($placeholders)
        ORDER BY c.created_at DESC
    ");
    $stmt->execute($idsEventos);
    
    while ($comentario = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $comentariosPorEvento[$comentario['id_evt']][] = $comentario;
    }
}
?>