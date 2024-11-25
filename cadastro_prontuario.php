<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'config.php';

    try {
        $pdo->beginTransaction();

        $stmtAvaliacao = $pdo->prepare("
            INSERT INTO avaliacao (id_paciente, data_avaliacao, queixa_principal, outras_queixas) 
            VALUES (:id_paciente, :data_avaliacao, :queixa_principal, :outras_queixas)
        ");
        $stmtAvaliacao->execute([
            ':id_paciente' => $_POST['id_paciente'],
            ':data_avaliacao' => $_POST['data_avaliacao'],
            ':queixa_principal' => $_POST['queixa_principal'],
            ':outras_queixas' => $_POST['outras_queixas']
        ]);
        $idAvaliacao = $pdo->lastInsertId();


        $stmtAvaliacaoFisica = $pdo->prepare("
            INSERT INTO avaliacao_fisica (id_avaliacao, postura_cabeca, postura_ombro, postura_coluna_cervical, postura_coluna_lombar)
            VALUES (:id_avaliacao, :postura_cabeca, :postura_ombro, :postura_coluna_cervical, :postura_coluna_lombar)
        ");
        $stmtAvaliacaoFisica->execute([
            ':id_avaliacao' => $idAvaliacao,
            ':postura_cabeca' => $_POST['postura_cabeca'],
            ':postura_ombro' => $_POST['postura_ombro'],
            ':postura_coluna_cervical' => $_POST['postura_coluna_cervical'],
            ':postura_coluna_lombar' => $_POST['postura_coluna_lombar']
        ]);
        $idAvaliacaoFisica = $pdo->lastInsertId();

       
        $stmtForcaMuscular = $pdo->prepare("
            INSERT INTO forca_muscular (id_avaliacao_fisica, grau_forca) 
            VALUES (:id_avaliacao_fisica, :grau_forca)
        ");
        $stmtForcaMuscular->execute([
            ':id_avaliacao_fisica' => $idAvaliacaoFisica,
            ':grau_forca' => $_POST['grau_forca']
        ]);

    
        $stmtPerimetria = $pdo->prepare("
            INSERT INTO perimetria (id_avaliacao_fisica, regiao, medida_1, medida_2, medida_3) 
            VALUES (:id_avaliacao_fisica, :regiao, :medida_1, :medida_2, :medida_3)
        ");
        $stmtPerimetria->execute([
            ':id_avaliacao_fisica' => $idAvaliacaoFisica,
            ':regiao' => $_POST['regiao'],
            ':medida_1' => $_POST['medida_1'],
            ':medida_2' => $_POST['medida_2'],
            ':medida_3' => $_POST['medida_3']
        ]);

        $stmtPlanoTerapeutico = $pdo->prepare("
            INSERT INTO plano_terapeutico (id_avaliacao, diagnostico_cinesiologico, objetivos_terapeuticos) 
            VALUES (:id_avaliacao, :diagnostico_cinesiologico, :objetivos_terapeuticos)
        ");
        $stmtPlanoTerapeutico->execute([
            ':id_avaliacao' => $idAvaliacao,
            ':diagnostico_cinesiologico' => $_POST['diagnostico_cinesiologico'],
            ':objetivos_terapeuticos' => $_POST['objetivos_terapeuticos']
        ]);

        $stmtSensibilidade = $pdo->prepare("
            INSERT INTO sensibilidade (id_avaliacao_fisica, local, sensibilidade_tatil_direito, sensibilidade_tatil_esquerdo) 
            VALUES (:id_avaliacao_fisica, :local, :sensibilidade_tatil_direito, :sensibilidade_tatil_esquerdo)
        ");
        $stmtSensibilidade->execute([
            ':id_avaliacao_fisica' => $idAvaliacaoFisica,
            ':local' => $_POST['local'],
            ':sensibilidade_tatil_direito' => $_POST['sensibilidade_tatil_direito'],
            ':sensibilidade_tatil_esquerdo' => $_POST['sensibilidade_tatil_esquerdo']
        ]);

      
        $stmtTestesEspeciais = $pdo->prepare("
            INSERT INTO testes_especiais (id_avaliacao_fisica, descricao) 
            VALUES (:id_avaliacao_fisica, :descricao)
        ");
        $stmtTestesEspeciais->execute([
            ':id_avaliacao_fisica' => $idAvaliacaoFisica,
            ':descricao' => $_POST['descricao']
        ]);

        $pdo->commit();

        echo "<p>Avaliação completa cadastrada com sucesso!</p>";
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "<p>Erro ao cadastrar avaliação: " . $e->getMessage() . "</p>";
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
    </style>
</head>
<body>
<header>
    <style>
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
    </style>
</head>
<body>
    <header>
        <h1>Cadastro Completo de Avaliação</h1>
    </header>

    <main>
        <form method="POST" action="">
   
            <h2>Avaliação</h2>
            <label for="id_paciente">ID do Paciente:</label>
            <input type="number" name="id_paciente" required>

            <label for="data_avaliacao">Data da Avaliação:</label>
            <input type="date" name="data_avaliacao" required>

            <label for="queixa_principal">Queixa Principal:</label>
            <textarea name="queixa_principal"></textarea>

            <label for="outras_queixas">Outras Queixas:</label>
            <textarea name="outras_queixas"></textarea>
            
            <label for="comorbidades">Comorbidades:</label>
            <textarea name="comorbidades"></textarea>
            
            <label for="medicamentos_uso_continuo">Medicaments de uso continuo:</label>
            <textarea name="medicamentos_uso_continuo"></textarea>
            
            <label for="medicamentos_atuais">Medicamentos Atuais:</label>
            <textarea name="medicamentos_atuais"></textarea>
            
            <label for="tratamentos_complementares">Tratamentos Complementares:</label>
            <textarea name="tratamentos_complementares"></textarea>
            
            <label for="diagnostico_clinico">Diagnóstico Clínico:</label>
            <textarea name="diagnostico_clinico"></textarea>
            
            <label for="cid">CID:</label>
            <textarea name="cid"></textarea>
            
            <label for="historia_doenca_atual">Historico da Doenca Atual:</label>
            <textarea name="historia_doenca_atual"></textarea>
            
            <label for="historia_doenca_pregressa">Historico de doenca pregressa:</label>
            <textarea name="historia_doenca_pregressa"></textarea>
            
            <label for="antecedentes_cirurgicos">Antecendentes Cirurgicos:</label>
            <textarea name="antecedentes_cirurgicos"></textarea>
            
            <label for="atividades_afetadas">Atividades Afetadas:</label>
            <textarea name="atividades_afetadas"></textarea>
            
            <label for="fatores_ambientais">Fatores Ambientais:</label>
            <textarea name="fatores_ambientais"></textarea>
            
            <label for="observacoes">Observações:</label>
            <textarea name="observacoes"></textarea>

            <hr>

      
            <h2>Avaliação Física</h2>
            <label for="postura_cabeca">Postura da Cabeça:</label>
            <input type="text" name="postura_cabeca">

            <label for="postura_clavicula">Postura do Clavicula:</label>
            <input type="text" name="postura_clavicula">
            
            <label for="postura_ombro">Postura do Ombro:</label>
            <input type="text" name="postura_ombro">
            
            <label for="postura_cotovelo">Postura do Cotovelo:</label>
            <input type="text" name="postura_cotovelo">
            
            <label for="postura_antebraco">Postura do Antebraço:</label>
            <input type="text" name="postura_antebraco">
            
            <label for="postura_maos">Postura do Mão:</label>
            <input type="text" name="postura_maos">
            
            <label for="postura_eias">Postura do Eia:</label>
            <input type="text" name="postura_eias">
            
            <label for="postura_joelhos">Postura do Joelho:</label>
            <input type="text" name="postura_joelhos">
            
            <label for="postura_tornozelos">Postura do Tornozelo:</label>
            <input type="text" name="postura_tornozelos">
                        
            <label for="postura_patelas">Postura do Patela:</label>
            <input type="text" name="postura_patelas">
                        
            <label for="informacoes_adm">Informações do ADM:</label>
            <input type="text" name="informacoes_adm">
                        
            <label for="inspecao_palapacao">Inspeção da Palpação:</label>
            <input type="text" name="inspecao_palapacao">
                        
            <label for="postura_coluna_toracica">Postura da Coluna Toracica:</label>
            <input type="text" name="postura_coluna_toracica">
        
            <label for="postura_coluna_cervical">Postura da Coluna Cervical:</label>
            <input type="text" name="postura_coluna_cervical">

            <label for="postura_coluna_lombar">Postura da Coluna Lombar:</label>
            <input type="text" name="postura_coluna_lombar">

            <hr>

    
            <h2>Força Muscular</h2>
            <label for="grau_forca">Grau de Força:</label>
            <input type="text" name="grau_forca">

            <hr>

      
            <h2>Perimetria</h2>
            <label for="regiao">Região:</label>
            <input type="text" name="regiao">

            <label for="medida_1">Medida 1:</label>
            <input type="number" step="0.01" name="medida_1">

            <label for="medida_2">Medida 2:</label>
            <input type="number" step="0.01" name="medida_2">

            <label for="medida_3">Medida 3:</label>
            <input type="number" step="0.01" name="medida_3">

            <hr>

            <h2>Plano Terapêutico</h2>
            <label for="diagnostico_cinesiologico">Diagnóstico Cinesiológico:</label>
            <textarea name="diagnostico_cinesiologico"></textarea>

            <label for="objetivos_terapeuticos">Objetivos Terapêuticos:</label>
            <textarea name="objetivos_terapeuticos"></textarea>

            <label for="conduta_fisioterapeutica">Objetivos Fisioterapeuticos:</label>
            <textarea name="conduta_fisioterapeutica"></textarea>

            <label for="objetivos_paciente">Objetivos Paciente:</label>
            <textarea name="objetivos_paciente"></textarea>

            <hr>

   
            <h2>Sensibilidade</h2>
            <label for="local">Local:</label>
            <input type="text" name="local">

            <label for="sensibilidade_tatil_direito">Sensibilidade Tátil Direito:</label>
            <select name="sensibilidade_tatil_direito">
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>

            <label for="sensibilidade_tatil_esquerdo">Sensibilidade Tátil Esquerdo:</label>
            <select name="sensibilidade_tatil_esquerdo">
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
            
            <label for="sensibilidade_dolorosa_direito">Sensibilidade Dolorosa Direito:</label>
            <select name="sensibilidade_dolorosa_direito">
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
            
            <label for="sensibilidade_dolorosa_esquerdo">Sensibilidade Dolorosa Esquerdo:</label>
            <select name="sensibilidade_dolorosa_esquerdo">
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
            
            <label for="sensibilidade_termica_direito">Sensibilidade Termica Esquerdo:</label>
            <select name="sensibilidade_termica_direito">
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
            
            <label for="sensibilidade_termica_esquerdo">Sensibilidade Termica Esquerdo:</label>
            <select name="sensibilidade_termica_esquerdo">
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>

            <hr>

        
            <h2>Testes Especiais</h2>
            <label for="descricao">Descrição:</label>
            <textarea name="descricao"></textarea>

            <button type="submit">Cadastrar Avaliação Completa</button>
        </form>
    </main>
</body>
</html>