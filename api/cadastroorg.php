<?php
require_once('/laragon/www/conexaolocal/api/config.php');


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


?>