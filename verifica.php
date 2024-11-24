<?php
// Configuração da conexão com o banco de dados
$host = 'localhost'; // Host do banco de dados
$dbname = 'clinica'; // Nome do banco de dados
$username = 'root'; // Usuário do banco
$password = ''; // Senha do banco (geralmente vazia no XAMPP)

try {
    // Cria a conexão com o banco usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Configura o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Exibe uma mensagem de erro se a conexão falhar
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Inicia a sessão
session_start();

// Verifica se o usuário está logado verificando os dados da sessão
if (!isset($_SESSION["id_usuario"]) || !isset($_SESSION["nome_usuario"])) {
    // Usuário não logado! Redireciona para a página de login
    header("Location: login.php");
    exit;
}

// Caso o usuário esteja logado, você pode utilizar a variável $_SESSION["id_usuario"]
// para fazer consultas no banco ou carregar informações do usuário

?>
