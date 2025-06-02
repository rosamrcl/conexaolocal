<?php
include ('/laragon/www/conexaolocal/api/config.php');


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
        header("Location: /laragon/www/conexaolocal/app/eventos.php");
        exit();
    }else{
        echo json_encode(["status"=>"erro", "mensagem"=>"Usuário ou senha inválida."]);
    }

}else{
    echo json_encode(["status" => "erro", "mensagem"=> "Metódo inválido. Use POST."]); 
}

?>