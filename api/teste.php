<?php
//adicione um arquivo auth.php para gerenciar a autenticação:
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

function requireGuest() {
    if (isLoggedIn()) {
        header('Location: index.php');
        exit();
    }
}

// login

require_once 'auth.php';
requireGuest();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Processar login
    $username = $_POST['username'];
    $senha = $_POST['senha'];
    
    // Verificar credenciais no banco
    $stmt = $pdo->prepare("SELECT id_usuario, senha FROM usuario WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['user_id'] = $user['id_usuario'];
        header('Location: index.php');
        exit();
    } else {
        $error = "Credenciais inválidas";
    }
}
//Formulário de login HTML aqui -->

//register
require_once 'auth.php';
requireGuest();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Processar registro
    $nome = $_POST['nome'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    
    try {
        $stmt = $pdo->prepare("INSERT INTO usuario (nome, username, email, senha) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $username, $email, $senha]);
        
        header('Location: login.php');
        exit();
    } catch (PDOException $e) {
        $error = "Erro ao registrar: " . $e->getMessage();
    }
}

//Proteger as páginas do site
require_once 'auth.php';
requireLogin();

// Restante do código da página

//logout

session_start();
session_destroy();
header('Location: login.php');
exit();

//menu navegação
//php if (isLoggedIn()): 
    !-- Menu para usuários logados --
    a href="perfil.php">Meu Perfil/a
    a href="eventos.php">Eventos</a>
    a href="logout.php">Sair</a>
//php else: 
    !-- Menu para visitantes --
a href="login.php">Login</a>
    a href="register.php">Registrar/a
//php endif; 

//proteção 

// No código que processa o formulário de criar evento
requireLogin();

// Verificar se o usuário é um organizador
$stmt = $pdo->prepare("SELECT id_org FROM organizador WHERE id_usuario = ?");
$stmt->execute([$_SESSION['user_id']]);
$org = $stmt->fetch();

if (!$org) {
    die("Apenas organizadores podem criar eventos");
}

// Processar criação do evento...
<?php
include('/laragon/www/conexaolocal/api/config.php');

// Cria tabela usuario
$pdo->exec("CREATE TABLE IF NOT EXISTS usuario (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(250) NOT NULL,
    username VARCHAR(250) UNIQUE NOT NULL,
    email VARCHAR(250) UNIQUE NOT NULL,
    senha VARCHAR(250) NOT NULL
)");



// Cria tabela organizador 
$pdo->exec("CREATE TABLE IF NOT EXISTS organizador (
    id_org INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    nome_org VARCHAR(250) NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)  ON DELETE CASCADE
)");

// Cria tabela evento 
$pdo->exec("CREATE TABLE IF NOT EXISTS evento (
    id_evt INT PRIMARY KEY AUTO_INCREMENT,
    id_org INT NOT NULL,
    nome_evt VARCHAR(250) NOT NULL,
    descricao VARCHAR(250) NOT NULL,
    start_date_event DATETIME NOT NULL,
    end_date DATETIME,
    local_evento VARCHAR(255),
    endereco VARCHAR(255),
    cidade VARCHAR(100),
    preco DECIMAL(10,2) DEFAULT 0.00,
    status_evento ENUM('Ativo', 'Cancelado', 'Encerrado') DEFAULT 'Ativo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_org) REFERENCES organizador(id_org)  ON DELETE CASCADE
)");

// Cria tabela interacao 
$pdo->exec("CREATE TABLE IF NOT EXISTS interacao (
    id_interacao INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_evt INT NOT NULL,
    tipo ENUM('like', 'subscribe', 'favorite') NOT NULL,
    UNIQUE ( id_usuario, id_evt, tipo),
    FOREIGN KEY ( id_usuario) REFERENCES usuario( id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_evt) REFERENCES evento(id_evt) ON DELETE CASCADE
)");

// Cria tabela comentario
$pdo->exec("CREATE TABLE IF NOT EXISTS comentario (
    id_cmt INT PRIMARY KEY AUTO_INCREMENT,
    comentario VARCHAR(250) NOT NULL,
    id_usuario INT NOT NULL,
    id_evt INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),    
    FOREIGN KEY (id_evt) REFERENCES evento(id_evt)
)");
?>



?>