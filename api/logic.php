<?php
include ("/laragon/www/conexaolocal/api/config.php");




if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar'])) {
    // 1. Coleta e sanitiza os dados do formulário
    $nome = trim($_POST['nome'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? ''; 

    // 2. Validação de campos vazios
    if (empty($nome) || empty($username) || empty($email) || empty($senha)) {
        header("Location: index.php?erro=campos_vazios");
        exit();
    }

    // 3. Verifica se já existe um usuário ou e-mail cadastrado
    $check = $pdo->prepare("SELECT id_usuario FROM usuario WHERE username = :username OR email = :email");
    $check->bindParam(':username', $username);
    $check->bindParam(':email', $email);
    $check->execute();

    if ($check->rowCount() > 0) {
        echo "Usuário ou e-mail já cadastrados.";
        header("Location: index.php?erro=usuario_email_duplicado");
        exit();
    }

    // 4. Hash da senha para segurança
    $hashedPassword = password_hash($senha, PASSWORD_DEFAULT);

    // 5. Prepara e executa a inserção no banco de dados
    $stmt = $pdo->prepare("INSERT INTO usuario (nome, username, email, senha) VALUES (:nome, :username, :email, :senha)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $hashedPassword);

    if ($stmt->execute()) {
        // Redireciona para a página principal após o sucesso
        header("Location: index.php?sucesso=cadastro");
        exit();
    } else {
        header("Location: index.php?erro=cadastro_falhou");
        exit();
    }
}
?>






