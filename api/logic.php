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






if ($_SERVER['REQUEST_METHOD'] ==='POST' && isset($_POST['adicionar_organizador'])){
    if(!empty($_POST['nome_org'])
    && !empty ($_POST['id_usuario'])){
        $stmt = $pdo->prepare("INSERT INTO organizador (nome_org, id_usuario) VALUES (?, ?)");
        $stmt->execute([$_POST['nome_org'], 
        $_POST['id_usuario']]);
        header("Location: index.php");
        exit();
    }
}
// if ($_SERVER['REQUEST_METHOD'] ==='POST' && isset($_POST['adicionar_evento'])){
//     if(!empty($_POST['nome_evt'])
//     && !empty ($_POST['id_org'])
//     && !empty($_POST['id_interacao'])){
//         $stmt = $pdo->prepare("INSERT INTO evento (nome_evt, id_org, id_interacao) VALUES (?, ?, ?, ?)");
//         $stmt->execute([$_POST['nome_evt'], 
//         $_POST['id_org'], 
//         $_POST['id_interacao']]);
//         header("Location: index.php");
//         exit();
//     }
// }



    

//DELETE
// if (isset($_GET['delete'])){
//     $stmt=$pdo->prepare("DELETE FROM produto WHERE id=?");
//     $stmt->execute([$_GET['delete']]);
//     header("Location: index.php");
//     exit();    
// }

//SELEÇÃO
// $order = "product.nome ASC";
// if(isset($_GET['filtro'])){
//     switch ($_GET['filtro']){
//         case 'crescente':
//             $order = "product.nome ASC";
//             break;
//         case 'decrescente':
//             $order = "product.nome DESC";
//             break;
//         case 'crescente_quantidade':
//             $order = "product.quantidade ASC";
//             break;
//         case 'decrescente_quantidade':
//             $order = "product.quantidade DESC";
//             break;
//         case 'id':
//             $order = "product.id ASC";
//             break;
//     }
// }

// $produtos = $pdo->query("SELECT product.*, c.nome_categoria AS categoria FROM produto product JOIN categoria c ON product.categoria_id = c.id_categoria ORDER BY $order")->fetchAll(PDO::FETCH_ASSOC);



?>