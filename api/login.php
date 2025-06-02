<?php
include ("/laragon/www/conexaolocal/api/config.php");

session_start();


if ($_SERVER['REQUEST_METHOD']==='POST'){
    $login = $_POST['username'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if(empty($login)|| empty($senha)){
        echo json_encode(["status" => "erro", "mensagem" => "Preencha todos os campos."]);
        exit;
    }
    $sql = "SELECT * FROM usuario WHERE email= :login OR username = :login";
    $stmt = $pdo->prepare($sql);
    $stmt ->bindParam(':login',$login);
    $stmt->execute();
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($senha, $user['senha'])){
        $_SESSION['usuario']=[
            'id_usuario'=>$user['id_usuario'],
            'nome'=>$user['nome'],
            'username'=>$user['username'],
            'email'=>$user['email']
        ];
        header("Location: /laragon/www/conexaolocal/app/eventos.php");
        exit;
    }else{
        $_SESSION['erro_login']="Usuário ou senha inválidos";
        header('Location: /laragon/www/conexaolocal/app/login.php');
        exit;
    }
}

?>