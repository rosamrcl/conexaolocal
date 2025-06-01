<?php
include("/laragon/www/conexaolocal/api/config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    // Verifica se já tem alguma pessoa utilizando o email ou username.
    $check = $pdo->prepare("SELECT id_usuario FROM usuario WHERE username = :username OR email = :email");
    $check->bindParam(':username', $username);
    $check->bindParam(':email', $email);
    $check->execute();

    if ($check->rowCount() > 0) {
        echo json_encode(["status" => "erro", "mensagem" => "Usuário ou e-mail já cadastrados."]);
        exit;
    }
    $hashedPassword = password_hash($senha, PASSWORD_DEFAULT); // Criptografa a senha

    $sql = "INSERT INTO usuario (nome, username, email,  senha) VALUES (:nome, :username, :email,  :senha)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);    
    $stmt->bindParam(':senha', $hashedPassword);

    if ($stmt->execute()) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Usuário cadastrado com sucesso!"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "Erro ao cadastrar usuário."]);
    }
} else {
    echo json_encode(["status" => "erro", "mensagem" => "Método inválido. Use POST."]);
}
?>
