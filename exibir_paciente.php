<?php

session_start();
require 'config.php'; 

$paciente = null; 

if (isset($_POST['id_paciente']) && !empty($_POST['id_paciente'])) {
    $id_paciente = $_POST['id_paciente'];

    $query = $pdo->prepare("SELECT * FROM paciente WHERE id_paciente = :id_paciente");
    $query->execute(['id_paciente' => $id_paciente]);

    $paciente = $query->fetch(PDO::FETCH_ASSOC);

    if (!$paciente) {
        $erro = "Paciente não encontrado!";
    }
} else {
    $erro = "Por favor, insira o ID do paciente.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exibir Ficha do Paciente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }
        header {
            background-color: #0066cc;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }
        main {
            max-width: 600px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #0066cc;
        }
        .info {
            margin-bottom: 15px;
        }
        .info label {
            font-weight: bold;
        }
        .info span {
            font-weight: normal;
        }
        .form-container {
            margin-bottom: 20px;
            text-align: center;
        }
        .form-container input {
            padding: 10px;
            font-size: 14px;
            width: 100px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form-container button {
            padding: 10px;
            font-size: 14px;
            background-color: #0066cc;
            color: white;
            border: none;
            border-radius: 5px;
        }
        .form-container button:hover {
            background-color: #005bb5;
        }
        .error {
            color: red;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <h1>Ficha do Paciente</h1>
    </header>

    <main>
        <div class="form-container">
            <form method="POST" action="">
                <label for="id_paciente">ID do Paciente: </label>
                <input type="number" name="id_paciente" required>
                <button type="submit">Buscar</button>
            </form>

            <?php
            if (isset($erro)) {
                echo "<p class='error'>$erro</p>";
            }
            ?>
        </div>

        <?php if ($paciente): ?>
            <h2>Dados Pessoais</h2>

            <div class="info">
                <label>Nome:</label>
                <span><?php echo htmlspecialchars($paciente['nome']); ?></span>
            </div>

            <div class="info">
                <label>Endereço:</label>
                <span><?php echo htmlspecialchars($paciente['endereco']); ?></span>
            </div>

            <div class="info">
                <label>Peso:</label>
                <span><?php echo $paciente['peso'] ? htmlspecialchars($paciente['peso']) . ' kg' : 'Não informado'; ?></span>
            </div>

            <div class="info">
                <label>Altura:</label>
                <span><?php echo $paciente['altura'] ? htmlspecialchars($paciente['altura']) . ' m' : 'Não informado'; ?></span>
            </div>

            <div class="info">
                <label>Data de Nascimento:</label>
                <span><?php echo date('d/m/Y', strtotime($paciente['data_nascimento'])); ?></span>
            </div>

            <div class="info">
                <label>Idade:</label>
                <span><?php echo htmlspecialchars($paciente['idade']) . ' anos'; ?></span>
            </div>

            <div class="info">
                <label>Gênero:</label>
                <span><?php echo htmlspecialchars($paciente['genero']); ?></span>
            </div>

            <div class="info">
                <label>Estado Civil:</label>
                <span><?php echo htmlspecialchars($paciente['estado_civil']); ?></span>
            </div>

            <div class="info">
                <label>Número de Gestações:</label>
                <span><?php echo $paciente['numero_gestacoes'] ?? 'Não informado'; ?></span>
            </div>

            <div class="info">
                <label>Número de Filhos:</label>
                <span><?php echo $paciente['numero_filhos'] ?? 'Não informado'; ?></span>
            </div>

            <div class="info">
                <label>Tipo de Parto:</label>
                <span><?php echo htmlspecialchars($paciente['tipo_parto']); ?></span>
            </div>

            <div class="info">
                <label>Nível de Escolaridade:</label>
                <span><?php echo htmlspecialchars($paciente['nivel_escolaridade']); ?></span>
            </div>

            <div class="info">
                <label>Profissão:</label>
                <span><?php echo htmlspecialchars($paciente['profissao']); ?></span>
            </div>

            <div class="info">
                <label>Ocupação:</label>
                <span><?php echo htmlspecialchars($paciente['ocupacao']); ?></span>
            </div>

            <div class="info">
                <label>Condição Física:</label>
                <span><?php echo htmlspecialchars($paciente['condicao_fisica']); ?></span>
            </div>

            <div class="info">
                <label>Tabagista:</label>
                <span><?php echo htmlspecialchars($paciente['tabagista']); ?></span>
            </div>

            <div class="info">
                <label>Etilista:</label>
                <span><?php echo htmlspecialchars($paciente['etilista']); ?></span>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
