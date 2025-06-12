<?php
// session_start();
require_once('/laragon/www/conexaolocal/api/config.php');
require_once('/laragon/www/conexaolocal/api/login.php');
require_once('/laragon/www/conexaolocal/api/cadastroevt.php');

if (isset($_GET['delete'])){
    $stmt=$pdo->prepare("DELETE FROM evento WHERE id=?");
    $stmt->execute([$_GET['delete']]);
    header("Location: organizador_evento.php");
    exit();    
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexão Local</title>
    <link rel="stylesheet" href="./ressources/css/style.css">
    <link rel="stylesheet" href="./ressources/css/header.css">
    <link rel="stylesheet" href="./ressources/css/cadastro.css">
    <link rel="stylesheet" href="./ressources/css/home.css">
    <link rel="stylesheet" href="./ressources/css/login.css">
    <link rel="stylesheet" href="./ressources/css/evento_org.css">
    <link rel="stylesheet" href="./ressources/css/eventointercoment.css">
    <link rel="stylesheet" href="./ressources/css/media.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header class="header">
        <div id="menu-bar" class="fas fa-bars"></div>
        <a target="_blank" href="index.php" class="logo"><img src="./ressources/img/logo.png" alt=""></a>
        <nav class="navbar">
            <a href="login.php">Home</a>
            <a href="cadastro.php">Cadastro</a>
            <a href="evento.php"">Eventos</a>      
        </nav>
        <h2>Bem-Vindo, <span><?= htmlspecialchars($_SESSION['username'] ?? '') ?></span></h2>
        <a href=" /api/logout.php">Sair</a>

    </header>


    <section class="home" id="home">
        <img src="./ressources/img/logo.png" alt="">
        <div class="imagens">
            <figure>
                <img src="./ressources/img/image01.png" alt="">
            </figure>
            <figure>
                <img src="./ressources/img/image02.png" alt="">
            </figure>
            <figure>
                <img src="./ressources/img/image03.png" alt="">
            </figure>
            <figure>
                <img src="./ressources/img/image04.png" alt="">
            </figure>
            <figure>
                <img src="./ressources/img/image05.png" alt="">
            </figure>
            <figure>
                <img src="./ressources/img/image06.png" alt="">
            </figure>
        </div>
    </section>
    <section class="organizadores">
        <form class="box" method="POST">
            <h3>Cadastre seu evento</h3>

            <input type="text" name="nome_evt" class="box" placeholder="Nome do evento" required>

            <textarea name="descricao" class="box" placeholder="Descrição" required></textarea>


            <label>Data de Início</label>
            <input type="date" name="start_date_event" class="box"
                required>

            <label>Data de Término</label>
            <input type="date" name="end_date" class="box"
                required>

            <input type="text" name="local_evento" class="box" placeholder="Local do evento"
                required>

            <input type="text" name="endereco" class="box" placeholder="Endereço"
                required>

            <input type="text" name="cidade" class="box" placeholder="Cidade" required>

            <input type="number" name="preco" step="0.01" class="box" placeholder="Preço" required>

            <select name="status_evento" class="box" required>
                <option value="Ativo">Ativo</option>
                <option value="Cancelado">Cancelado</option>
                <option value="Encerrado">Encerrado</option>
            </select>

            <input type="submit" value="Enviar" class="btn" name="evento_cadastro">
        </form>
    </section>
    <section class="eventos">
        <?php if (!empty($mensagem)): ?>
            <p class="mensagem"><?= htmlspecialchars($mensagem) ?></p>
        <?php endif; ?>
        <?php if (isset($eventos) && count($eventos) > 0): ?>
            <?php foreach ($eventos as $evento): ?>
                <div class="card">
                    <h2><?= htmlspecialchars($evento['nome_evt']) ?></h2>
                    <h3><?= htmlspecialchars($evento['descricao']) ?></h3>
                    <p><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($evento['start_date_event'])) ?></p>
                    <p><strong>Local:</strong> <?= htmlspecialchars($evento['local_evento']) ?> </p>
                    <p><strong>Endereço:</strong>  <?= htmlspecialchars($evento['endereco']) ?> (<?= htmlspecialchars($evento['cidade']) ?>)</p>
                    <p><strong>Preço:</strong> R$ <?= number_format($evento['preco'], 2, ',', '.') ?></p>
                    <a href="" class="btn">Editar</a> <a class="delete-btn" href="?delete=<?= $product['id']; ?>" onclick="return confirm ('Tem certeza que deseja excluir?')">Excluir</a>
                </div>
                
            <?php endforeach; ?>
            <?php elseif (isset($eventos)): ?>
            <p style="text-align: center;">Você ainda não criou nenhum evento.</p>
            <?php endif; ?>
    </section>


    <footer class="footer">
        <a target="_blank" href="https://github.com/RosaCL"><img src="./ressources/img/costureza.png" alt=""></a>
    </footer>

    <script src="./ressources/js/script.js"></script>
</body>

</html>