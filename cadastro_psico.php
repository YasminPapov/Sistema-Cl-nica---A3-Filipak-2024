<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'config.php';

    try {
        $pdo->beginTransaction();

      
        $stmtProntuario = $pdo->prepare("
            INSERT INTO prontuarios_psico (
                id_paciente, data_prontuario, queixa_principal, outras_queixas, 
                comorbidades, medicamentos_uso_continuo, medicamentos_atuais, 
                tratamentos_complementares, diagnostico_clinico, cid, historia_doenca, 
                resultados_testes_psicologicos, plano_terapeutico
            ) 
            VALUES (
                :id_paciente, :data_prontuario, :queixa_principal, :outras_queixas, 
                :comorbidades, :medicamentos_uso_continuo, :medicamentos_atuais, 
                :tratamentos_complementares, :diagnostico_clinico, :cid, :historia_doenca, 
                :resultados_testes_psicologicos, :plano_terapeutico
            )
        ");
        $stmtProntuario->execute([
            ':id_paciente' => $_POST['id_paciente'],
            ':data_prontuario' => $_POST['data_prontuario'],
            ':queixa_principal' => $_POST['queixa_principal'],
            ':outras_queixas' => $_POST['outras_queixas'],
            ':comorbidades' => $_POST['comorbidades'],
            ':medicamentos_uso_continuo' => $_POST['medicamentos_uso_continuo'],
            ':medicamentos_atuais' => $_POST['medicamentos_atuais'],
            ':tratamentos_complementares' => $_POST['tratamentos_complementares'],
            ':diagnostico_clinico' => $_POST['diagnostico_clinico'],
            ':cid' => $_POST['cid'],
            ':historia_doenca' => $_POST['historia_doenca'],
            ':resultados_testes_psicologicos' => $_POST['resultados_testes_psicologicos'] ?? null,
            ':plano_terapeutico' => $_POST['plano_terapeutico']
        ]);

      
        $pdo->commit();
        echo "<p>Prontuário cadastrado com sucesso!</p>";
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "<p>Erro ao cadastrar o prontuário: " . $e->getMessage() . "</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Completo de Avaliação</title>
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
            max-width: 800px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #0066cc;
            margin-bottom: 10px;
        }
        hr {
            border: none;
            border-top: 2px solid #ddd;
            margin: 20px 0;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
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
        header {
            background-color: #0066cc;
            color: white;
            padding: 15px 20px;
            text-align: center;
        }

        header nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 20px; 
        }

        header nav ul li {
            display: inline;
        }

        header nav ul li a {
            text-decoration: none;
            color: white; 
            font-size: 16px;
            font-weight: bold;
            transition: color 0.3s;
        }

        header nav ul li a:hover {
            color: #ffd700; 
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
            <li><a href="cadastro_prontuario.php">Cadastro de Prontuários</a></li>
            <li><a href="exibir_paciente.php">Pacientes</a></li>
            <li><a href="cadastro_paciente.php">Cadastro de Pacientes</a></li>
            <?php if (isset($_SESSION['usuario_nome'])): ?>
            <li><a href="#">Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></a></li>
            <li><a href="logout.php">Sair</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<main>
    <form method="POST" action="">
        <h2>Avaliação</h2>

        <label for="id_paciente">ID do Paciente:</label>
        <input type="number" name="id_paciente" required>

        <label for="data_prontuario">Data do Prontuário:</label>
        <input type="date" name="data_prontuario" required>

        <label for="queixa_principal">Queixa Principal:</label>
        <textarea name="queixa_principal"></textarea>

        <label for="outras_queixas">Outras Queixas:</label>
        <textarea name="outras_queixas"></textarea>

        <label for="comorbidades">Comorbidades:</label>
        <textarea name="comorbidades"></textarea>

        <label for="medicamentos_uso_continuo">Medicamentos de uso contínuo:</label>
        <textarea name="medicamentos_uso_continuo"></textarea>

        <label for="medicamentos_atuais">Medicamentos Atuais:</label>
        <textarea name="medicamentos_atuais"></textarea>

        <label for="tratamentos_complementares">Tratamentos Complementares:</label>
        <textarea name="tratamentos_complementares"></textarea>

        <label for="diagnostico_clinico">Diagnóstico Clínico:</label>
        <textarea name="diagnostico_clinico"></textarea>

        <label for="cid">CID:</label>
        <textarea name="cid"></textarea>

        <label for="historia_doenca">Histórico da Doença Atual:</label>
        <textarea name="historia_doenca"></textarea>

        <label for="resultados_testes_psicologicos">Resultados dos Testes Psicológicos:</label>
        <textarea name="resultados_testes_psicologicos"></textarea>

        <label for="plano_terapeutico">Plano Terapêutico:</label>
        <textarea name="plano_terapeutico"></textarea>

        <hr>

        <button type="submit">Salvar Avaliação</button>
    </form>
</main>

</body>
</html>
