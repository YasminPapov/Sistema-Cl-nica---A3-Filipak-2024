<?php
session_start();
require 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $id_paciente = $_POST['id_paciente'];
    $data_avaliacao = $_POST['data_avaliacao'];
    $queixa_principal = $_POST['queixa_principal'];

    $query_avaliacao = $pdo->prepare("INSERT INTO avaliacao (id_paciente, data_avaliacao, queixa_principal, outras_queixas, 
                                      comorbidades, medicamentos_uso_continuo, medicamentos_atuais, tratamentos_complementares, 
                                      diagnostico_clinico, cid, historia_doenca_atual, historia_doenca_pregressa, antecedentes_cirurgicos, 
                                      atividades_afetadas, fatores_ambientais, observacoes) 
                                      VALUES (:id_paciente, :data_avaliacao, :queixa_principal, :outras_queixas, :comorbidades, 
                                      :medicamentos_uso_continuo, :medicamentos_atuais, :tratamentos_complementares, :diagnostico_clinico, 
                                      :cid, :historia_doenca_atual, :historia_doenca_pregressa, :antecedentes_cirurgicos, :atividades_afetadas, 
                                      :fatores_ambientais, :observacoes)");
    $query_avaliacao->execute([
        'id_paciente' => $id_paciente,
        'data_avaliacao' => $data_avaliacao,
        'queixa_principal' => $queixa_principal,

    ]);


    $id_avaliacao = $pdo->lastInsertId();

    $postura_cabeca = $_POST['postura_cabeca'];
    $postura_ombro = $_POST['postura_ombro'];


    $query_avaliacao_fisica = $pdo->prepare("INSERT INTO avaliacao_fisica (id_avaliacao, postura_cabeca, postura_ombro, 
                                              postura_clavicula, postura_cotovelo, postura_antebraco, postura_maos, postura_eias, 
                                              postura_joelhos, postura_patelas, postura_tornozelos, postura_coluna_cervical, 
                                              postura_coluna_toracica, postura_coluna_lombar, inspecao_palapacao, informacoes_adm)
                                              VALUES (:id_avaliacao, :postura_cabeca, :postura_ombro, :postura_clavicula, :postura_cotovelo, 
                                              :postura_antebraco, :postura_maos, :postura_eias, :postura_joelhos, :postura_patelas, 
                                              :postura_tornozelos, :postura_coluna_cervical, :postura_coluna_toracica, :postura_coluna_lombar, 
                                              :inspecao_palapacao, :informacoes_adm)");
    $query_avaliacao_fisica->execute([
        'id_avaliacao' => $id_avaliacao,
        'postura_cabeca' => $postura_cabeca,

    ]);

    $grau_forca = $_POST['grau_forca'];

    $query_forca_muscular = $pdo->prepare("INSERT INTO forca_muscular (id_avaliacao_fisica, grau_forca) 
                                            VALUES (:id_avaliacao_fisica, :grau_forca)");
    $query_forca_muscular->execute([
        'id_avaliacao_fisica' => $id_avaliacao_fisica,
        'grau_forca' => $grau_forca
    ]);


    $regiao = $_POST['regiao'];
    $medida_1 = $_POST['medida_1'];



    $query_perimetria = $pdo->prepare("INSERT INTO perimetria (id_avaliacao_fisica, regiao, medida_1, medida_2, medida_3) 
                                       VALUES (:id_avaliacao_fisica, :regiao, :medida_1, :medida_2, :medida_3)");
    $query_perimetria->execute([
        'id_avaliacao_fisica' => $id_avaliacao_fisica,
        'regiao' => $regiao,
        'medida_1' => $medida_1,
        'medida_2' => $medida_2,
        'medida_3' => $medida_3
    ]);


    $diagnostico_cinesiologico = $_POST['diagnostico_cinesiologico'];

    $query_plano_terapeutico = $pdo->prepare("INSERT INTO plano_terapeutico (id_avaliacao, diagnostico_cinesiologico, 
                                               objetivos_terapeuticos, conduta_fisioterapeutica, objetivos_paciente) 
                                               VALUES (:id_avaliacao, :diagnostico_cinesiologico, :objetivos_terapeuticos, 
                                               :conduta_fisioterapeutica, :objetivos_paciente)");
    $query_plano_terapeutico->execute([
        'id_avaliacao' => $id_avaliacao,
        'diagnostico_cinesiologico' => $diagnostico_cinesiologico,

    ]);


    $sensibilidade_tatil_direito = $_POST['sensibilidade_tatil_direito'];

    $query_sensibilidade = $pdo->prepare("INSERT INTO sensibilidade (id_avaliacao_fisica, local, sensibilidade_tatil_direito, 
                                             sensibilidade_tatil_esquerdo, sensibilidade_dolorosa_direito, 
                                             sensibilidade_dolorosa_esquerdo, sensibilidade_termica_direito, 
                                             sensibilidade_termica_esquerdo) 
                                             VALUES (:id_avaliacao_fisica, :local, :sensibilidade_tatil_direito, 
                                             :sensibilidade_tatil_esquerdo, :sensibilidade_dolorosa_direito, 
                                             :sensibilidade_dolorosa_esquerdo, :sensibilidade_termica_direito, 
                                             :sensibilidade_termica_esquerdo)");
    $query_sensibilidade->execute([
        'id_avaliacao_fisica' => $id_avaliacao_fisica,
        'local' => $local,

    ]);


    $descricao = $_POST['descricao'];


    $query_testes_especiais = $pdo->prepare("INSERT INTO testes_especiais (id_avaliacao_fisica, descricao) 
                                              VALUES (:id_avaliacao_fisica, :descricao)");
    $query_testes_especiais->execute([
        'id_avaliacao_fisica' => $id_avaliacao_fisica,
        'descricao' => $descricao
    ]);

    $sucesso = "Cadastro completo realizado com sucesso!";
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
            max-width: 600px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
    </style>
</head>
<body>
    <header>
        <h1>Cadastro Completo de Avaliação</h1>
    </header>

    <main>
        <?php if (isset($sucesso)): ?>
            <p style="color: green; text-align: center;"><?php echo $sucesso; ?></p>
        <?php endif; ?>
        <form method="POST" action="">

            <label for="id_paciente">ID do Paciente:</label>
            <input type="number" name="id_paciente" required><br>

            <label for="data_avaliacao">Data da Avaliação:</label>
            <input type="date" name="data_avaliacao" required><br>

            <label for="queixa_principal">Queixa Principal:</label>
            <input type="text" name="queixa_principal"><br>

            <label for="postura_cabeca">Postura da Cabeça:</label>
            <input type="text" name="postura_cabeca"><br>

            <label for="postura_ombro">Postura do Ombro:</label>
            <input type="text" name="postura_ombro"><br>

            <label for="grau_forca">Grau de Força:</label>
            <input type="text" name="grau_forca"><br>

            <label for="regiao">Região:</label>
            <input type="text" name="regiao"><br>

            <label for="medida_1">Medida 1:</label>
            <input type="number" name="medida_1"><br>

            <label for="diagnostico_cinesiologico">Diagnóstico Cinesiológico:</label>
            <input type="text" name="diagnostico_cinesiologico"><br>

            <label for="sensibilidade_tatil_direito">Sensibilidade Tátil Direito:</label>
            <input type="number" name="sensibilidade_tatil_direito"><br>

            <label for="descricao">Descrição do Teste Especial:</label>
            <input type="text" name="descricao"><br>

            <button type="submit">Cadastrar Avaliação Completa</button>
        </form>
    </main>
</body>
</html>
