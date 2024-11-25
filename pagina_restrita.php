<?php
require 'config.php';
session_start();


if (!isset($_SESSION['usuario_id']) || $_SESSION['nivel_acesso'] !== 'Administrador') {
    
    header('Location: index.php');
    exit;
} else { header('Location: prontuarios.php'); }


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Restrita - Administrador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #0066cc;
            color: white;
            padding: 10px 20px;
        }
        main {
            padding: 20px;
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
    </style>
</head>
<body>
    <header>
        <h1>Página de Administrador</h1>
    </header>

    <main>
        <h2>Bem-vindo à área restrita para administradores!</h2>
        <p>Aqui você pode gerenciar os usuários e realizar outras ações administrativas.</p>

        <a href="logout.php">Sair</a>
    </main>

    <footer>
        <p>&copy; 2024 Clínica. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
