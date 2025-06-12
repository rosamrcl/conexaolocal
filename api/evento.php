<?php
session_start();
require_once('/laragon/www/conexaolocal/api/config.php');



// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit();
}




$stmt = $pdo->prepare("SELECT * FROM evento WHERE id_org = ? ORDER BY start_date_event ASC");
$stmt->execute([$_SESSION['id_org']]);
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
