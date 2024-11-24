<?php
// Inicia a sessão
session_start();

// Limpa todas as variáveis de sessão
session_unset();

// Destroi a sessão
session_destroy();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Clínica - Logout</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #add8e6;
            color: #333;
            text-align: center;
            padding: 50px;
        }
        h1 {
            color: #0066cc;
        }
        p {
            font-size: 18px;
            color: #333;
        }
        .message {
            font-weight: bold;
            color: red;
        }
        .redirect {
            margin-top: 20px;
            font-size: 16px;
        }
        a {
            color: #0066cc;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>Você saiu!</h1>
    <p class="message">Sua sessão foi encerrada com sucesso.</p>
    <p class="redirect">Você será redirecionado para a página de login em alguns segundos...</p>

    <!-- Redirecionamento automático para login após 3 segundos -->
    <meta http-equiv="refresh" content="3;url=index.php">

</body>
</html>
