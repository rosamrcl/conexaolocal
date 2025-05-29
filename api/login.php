<?php
include ('/laragon/www/conexaolocal/api/config.php');

if ($_SERVER['REQUEST_METHOD'] ==='POST'){
    $login=$_POST['username'] ?? '';
    $senha=$_POST['senha'] ?? '';

    if(empty($login)|| empty($senha)){
        echo json_encode(["status"=>"erro","mensagem"=>"Preencha todos os campos."]);
        exit;
    }
}

$sql="SELECT * FROM usuario WHERE username = :login";
$stmt = $pdo -> prepare($sql);
$stmt->bindParam(':login',$login);
$stmt->execute();


$usuario=$stmt->fetch(PDO::FETCH_ASSOC);


if($usuario && password_verify($senha, $usuario['senha'])){
    echo json_encode([
        "status" => "sucesso",
        "mensagem" => "Login realizado com sucesso!",
        "usuario"=> [
            "id" => $usuario['id_usuario'],
            "nome" => $usuario['nome'],
            "username" => $usuario['username'],
            "email" => $usuario['email']
            ]
        ]);
}else{
    echo json_encode(["status" => "erro", "mensagem" => "Usuário ou senha inválida."]);
}

?>