<?php
include ('/laragon/www/conexaolocal/api/config.php');

session_start();

if(empty($_POST) or (empty($_POST["username"]) or (empty($_POST ["senha"])))){
    header('Location: index.php');
    exit();
}

$username = $_POST["username"];
$senha = $_POST["senha"];
$sql = "SELECT * FROM usuario WHERE username = '($username)' AND senha ='($senha)'";

$res = $conn ->query($sql) or die($conn->error);

$row = $res->fetch_object();
$qtd = $res->num_rows;

if($qtd >0){
    $_SESSION["username"] = $username;
    $_SESSION["nome"] = $row->nome;
    header('Location: dashboard.php');
    exit();
}else{
    header('Location: index.php');
    exit();
}

?>