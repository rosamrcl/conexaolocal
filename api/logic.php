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