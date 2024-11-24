<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prontuários</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
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
            padding: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }

        section {
            background-color: white;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
            color: #0066cc;
            font-size: 18px;
        }

        form {
            display: flex;
          flex-direction: column;
          font-size: 14px;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        

        input {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 14px;
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
        input, select {
            margin-bottom: 15px;
             padding: 10px; 
             font-size: 14px; 
             border: 1px solid #ccc; 
             border-radius: 5px; 
             width: 100%; 
             box-sizing: border-box; 
        }


    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#">Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></a></li>
                <li><a href="logout.php">Sair</a></li>
                <li><a href="index.php">Login</a></li>
                <li><a href="cadastro.php">Cadastro</a></li>
                <li><a href="prontuarios.php">Prontuários</a></li>
                <li><a href="agenda.php">Agenda</a></li>
                <li><a href="relatorios.php">Relatórios</a></li>
        
            </ul>
        </nav>
    </header>


<?php
/*session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_paciente = $_POST['id_paciente'];
    $arquivo = $_FILES['arquivo'];

    $diretorio = 'uploads/';
    $caminho = $diretorio . basename($arquivo['name']);

    if (move_uploaded_file($arquivo['tmp_name'], $caminho)) {
        $query = $pdo->prepare("INSERT INTO Sessao (id_paciente, arquivo) VALUES (:id_paciente, :arquivo)");
        $query->execute(['id_paciente' => $id_paciente, 'arquivo' => $caminho]);
        echo "Arquivo enviado com sucesso.";
    } else {
        echo "Erro ao enviar o arquivo.";
    }
}*/
?>

 <main>
        <section>
            <h1>Prontuário</h1>

            

            <form method="POST" action="">
                <label for="texto">texto</label>
                <input type="text" name="nome">

                <label for="texto1">texto1</label>
                <input type="text" name="nome">

                <label for="texto2">texto2</label>
                <input type="text" name="nome">

                <button type="submit">Salvar</button>
                </form>
        </section>
    </main>

</form>

