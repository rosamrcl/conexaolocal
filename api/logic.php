<?php
include ("/laragon/www/conexaolocal/api/config.php");

if ($_SERVER['REQUEST_METHOD'] ==='POST' && isset($_POST['adicionar'])){
    if(!empty($_POST['nome'])
    && !empty ($_POST['username'])
    && !empty($_POST['email'])
    && !empty($_POST['senha'])){
        $stmt = $pdo->prepare("INSERT INTO usuario (nome, username, email, senha) VALUES (?, ?, ?, ?)");
        $stmt->execute([$_POST['nome'], 
        $_POST['username'], 
        $_POST['email'],
        $_POST['senha']]);
        header("Location: index.php");
        exit();
    }
}
// if ($_SERVER['REQUEST_METHOD'] ==='POST' && isset($_POST['adicionar_organizador'])){
//     if(!empty($_POST['nome_org'])
//     && !empty ($_POST['id_usuario'])){
//         $stmt = $pdo->prepare("INSERT INTO organizador (nome_org, id_usuario) VALUES (?, ?)");
//         $stmt->execute([$_POST['nome_org'], 
//         $_POST['id_usuario']]);
//         header("Location: index.php");
//         exit();
//     }
// }
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