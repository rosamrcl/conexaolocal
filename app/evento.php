<?php
require_once('/laragon/www/conexaolocal/api/config.php');
require_once('/laragon/www/conexaolocal/api/login.php');
require_once('/laragon/www/conexaolocal/api/evento.php');


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
            <a href="evento.php">Eventos</a>
        </nav>
        <h2>Bem-Vindo, <span><?= ($_SESSION['nome']) ?></span></h2>
        <a href="/api/logout.php">Sair</a>


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
    <section class="eventos">
        <div class="container"></div>
        <?php if (!empty($mensagem)): ?>
            <p class="mensagem"><?= htmlspecialchars($mensagem) ?></p>
        <?php endif; ?>
        <?php if (isset($eventos) && count($eventos) > 0): ?>
            <?php foreach ($eventos as $evento): ?>

                <form class="box" method="POST">
                    <div class="card">
                        <h2><?= htmlspecialchars($evento['nome_evt']) ?></h2>
                        <h3><?= htmlspecialchars($evento['descricao']) ?></h3>
                        <p><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($evento['start_date_event'])) ?></p>
                        <p><strong>Local:</strong> <?= htmlspecialchars($evento['local_evento']) ?> <?= htmlspecialchars($evento['endereco']) ?> (<?= htmlspecialchars($evento['cidade']) ?>)</p>
                        <p><strong>Preço:</strong> R$ <?= number_format($evento['preco'], 2, ',', '.') ?></p>
                    </div>
                    <button class="curtir" id="curtir"  name="curtir" type="submit" <?= isset($curtidas[$evento['id_evt']]) ? 'disabled style="color:red;"' : '' ?>>
                        <i class="fa-solid fa-heart"></i>
                    </button>
                    <button class="seguir" id="seguir" name="seguir" type="submit" <?= isset($curtidas[$evento['id_evt']]) ? 'disabled style="color:red;"' : '' ?>>
                        <i class="fa-solid fa-bell"></i></i>
                    </button>
                    <input type="hidden" name="id_evt" value="<?= $evento['id_evt'] ?>">
                    <divv class="comentario">
                        <?php if (!empty($comentariosPorEvento[$evento['id_evt']])): ?>
                            <div class="comentarios">
                                <h4>Comentários:</h4>
                                <?php foreach ($comentariosPorEvento[$evento['id_evt']] as $comentario): ?>
                                    <div class="comentario">
                                        <strong><?= htmlspecialchars($comentario['nome']) ?></strong>
                                        <p><?= htmlspecialchars($comentario['comentario']) ?></p>
                                        <small><?= date('d/m/Y H:i', strtotime($comentario['created_at'])) ?></small>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <textarea name="comentario" class="box" placeholder="Digite seu comentário"></textarea>
                    </div>              

                    <button type="submit" class="botao">Enviar</button>
                </form>
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