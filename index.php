<?php
// Inclua o arquivo de configuração com a conexão ao banco de dados
require 'config.php';

session_start();

$erro = ''; // Variável para armazenar mensagens de erro

// Verifica se o usuário já está logado, caso sim, redireciona para a página inicial
if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $senha_hash = trim($_POST['senha_hash']);

    if (!empty($email) && !empty($senha_hash)) {
        // Preparar a consulta para verificar o usuário no banco de dados
        $query = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $query->execute(['email' => $email]);
        $usuario = $query->fetch();

        if ($usuario && password_verify($senha_hash, $usuario['senha_hash'])) {
            // Login bem-sucedido
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];

            // Redirecionar para a página inicial
            header('Location: index.php');
            exit;
        } else {
            // Credenciais inválidas
            $erro = 'Email ou senha inválidos.';
        }
    } else {
        $erro = 'Por favor, preencha todos os campos.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Clínica - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #add8e6;
            color: #333;
        }
        header {
            background-color: #0066cc;
            color: white;
            padding: 5px 20px;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-around;
        }
        nav ul li {
            display: inline;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        nav ul li a:hover {
            text-decoration: underline;
        }
        main {
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }
        section {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #0066cc;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            background-color: #0066cc;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #005bb5;
        }
        footer {
            background-color: #0066cc;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        p.erro {
            color: red;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Login</a></li>
                <li><a href="cadastro.php">Cadastro</a></li>
                <li><a href="prontuarios.php">Prontuários</a></li>
                <li><a href="agenda.php">Agenda</a></li>
                <li><a href="relatorios.php">Relatórios</a></li>
                <?php if (isset($_SESSION['usuario_nome'])): ?>
                <li><a href="#">Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></a></li>
                <li><a href="logout.php">Sair</a></li>
                    
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h1>Login</h1>

            <?php if (!empty($erro)): ?>
                <p class="erro"><?php echo htmlspecialchars($erro); ?></p>
            <?php endif; ?>

            <form method="POST" action="">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Digite seu email" required>
                <label for="senha_hash">Senha:</label>
                <input type="password" id="senha_hash" name="senha_hash" placeholder="Digite sua senha" required>
                <button type="submit">Entrar</button>
            </form>
        </section>
    </main>

    <footer> 
        <p>&copy; 2024 Clínica. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
