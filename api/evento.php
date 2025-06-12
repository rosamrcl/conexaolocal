<?php
session_start();
require_once('/laragon/www/conexaolocal/api/config.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit();
}

// Supondo que o id_org está na sessão (ajuste conforme sua aplicação)
$id_org = $_SESSION['id_usuario']; // ou $_SESSION['id_org'] se for diferente

$stmt = $pdo->prepare("SELECT * FROM evento WHERE id_org = :id");
$stmt->bindParam(':id', $id_org);
$stmt->execute();
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



