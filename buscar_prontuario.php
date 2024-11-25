<?php
session_start();
require 'config.php';  

if (isset($_GET['id_paciente']) && !empty($_GET['id_paciente'])) {
    $idPaciente = $_GET['id_paciente'];

    try {
      
        $stmt = $pdo->prepare("SELECT * FROM prontuarios_psico WHERE id_paciente = :id_paciente");
        $stmt->execute([':id_paciente' => $idPaciente]);
        
     
        $prontuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($prontuarios) {
      
            echo "<h1>Prontuários - Paciente ID: " . $idPaciente . "</h1>";

            foreach ($prontuarios as $prontuario) {
                echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;'>";
                echo "<p><strong>ID do Prontuário:</strong> " . $prontuario['id_prontuario'] . "</p>";
                echo "<p><strong>Nome do Paciente:</strong> " . $prontuario['nome_paciente'] . "</p>";
                echo "<p><strong>Histórico de Doença Atual:</strong> " . $prontuario['historia_doenca_atual'] . "</p>";
                echo "<p><strong>Diagnóstico:</strong> " . $prontuario['diagnostico'] . "</p>";
                echo "<p><strong>Tratamento:</strong> " . $prontuario['tratamento'] . "</p>";
                echo "<p><strong>Observações:</strong> " . $prontuario['observacoes'] . "</p>";
                echo "</div>";
            }

        } else {
            echo "<p>Não foram encontrados prontuários para o paciente com ID: " . $idPaciente . "</p>";
        }

    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "<p>Por favor, insira um ID válido de paciente.</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Prontuário pelo ID do Paciente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        header {
            background-color: #0066cc;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }
        .form-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
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
    </style>
</head>
<body>

    <header>
        <h1>Buscar Prontuário pelo ID do Paciente</h1>
    </header>

    <div class="form-container">
        <form action="exibir_prontuario.php" method="get">
            <label for="id_paciente">ID do Paciente:</label>
            <input type="text" name="id_paciente" id="id_paciente" required>
            <button type="submit">Buscar</button>
        </form>
    </div>

</body>
</html>
