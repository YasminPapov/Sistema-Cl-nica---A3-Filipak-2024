<?php
require 'config.php';
$dadosAvaliacao = null;
session_start();



if (isset($_SESSION['usuario_id'])) {
  
    header('Location: prontuarios.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idAvaliacao = $_POST['id_avaliacao'];

    try {
    
        $stmtAvaliacao = $pdo->prepare("
            SELECT * FROM avaliacao WHERE id_avaliacao = :id_avaliacao
        ");
        $stmtAvaliacao->execute([':id_avaliacao' => $idAvaliacao]);
        $dadosAvaliacao = $stmtAvaliacao->fetch(PDO::FETCH_ASSOC);

        if ($dadosAvaliacao) {
         
            $stmtAvaliacaoFisica = $pdo->prepare("
                SELECT * FROM avaliacao_fisica WHERE id_avaliacao = :id_avaliacao
            ");
            $stmtAvaliacaoFisica->execute([':id_avaliacao' => $idAvaliacao]);
            $dadosAvaliacaoFisica = $stmtAvaliacaoFisica->fetch(PDO::FETCH_ASSOC);

      
            $stmtForcaMuscular = $pdo->prepare("
                SELECT * FROM forca_muscular WHERE id_avaliacao_fisica = :id_avaliacao_fisica
            ");
            $stmtForcaMuscular->execute([':id_avaliacao_fisica' => $dadosAvaliacaoFisica['id_avaliacao_fisica']]);
            $dadosForcaMuscular = $stmtForcaMuscular->fetch(PDO::FETCH_ASSOC);

            $stmtPerimetria = $pdo->prepare("
                SELECT * FROM perimetria WHERE id_avaliacao_fisica = :id_avaliacao_fisica
            ");
            $stmtPerimetria->execute([':id_avaliacao_fisica' => $dadosAvaliacaoFisica['id_avaliacao_fisica']]);
            $dadosPerimetria = $stmtPerimetria->fetchAll(PDO::FETCH_ASSOC);

            $stmtPlanoTerapeutico = $pdo->prepare("
                SELECT * FROM plano_terapeutico WHERE id_avaliacao = :id_avaliacao
            ");
            $stmtPlanoTerapeutico->execute([':id_avaliacao' => $idAvaliacao]);
            $dadosPlanoTerapeutico = $stmtPlanoTerapeutico->fetch(PDO::FETCH_ASSOC);

            $stmtSensibilidade = $pdo->prepare("
                SELECT * FROM sensibilidade WHERE id_avaliacao_fisica = :id_avaliacao_fisica
            ");
            $stmtSensibilidade->execute([':id_avaliacao_fisica' => $dadosAvaliacaoFisica['id_avaliacao_fisica']]);
            $dadosSensibilidade = $stmtSensibilidade->fetchAll(PDO::FETCH_ASSOC);

            $stmtTestesEspeciais = $pdo->prepare("
                SELECT * FROM testes_especiais WHERE id_avaliacao_fisica = :id_avaliacao_fisica
            ");
            $stmtTestesEspeciais->execute([':id_avaliacao_fisica' => $dadosAvaliacaoFisica['id_avaliacao_fisica']]);
            $dadosTestesEspeciais = $stmtTestesEspeciais->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (Exception $e) {
        echo "<p>Erro ao buscar os dados: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exibição de Avaliação</title>
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
        input {
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
        .data-section {
            margin-bottom: 20px;
        }
        .data-section h3 {
            margin-bottom: 10px;
            color: #333;
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
            <label for="id_avaliacao">ID da Avaliação:</label>
            <input type="number" id="id_avaliacao" name="id_avaliacao" required>
            <button type="submit">Buscar</button>
        </form>

        <?php if ($dadosAvaliacao): ?>
            <div class="data-section">
                <h3>Avaliação</h3>
                <p><strong>ID Paciente:</strong> <?= htmlspecialchars($dadosAvaliacao['id_paciente']) ?></p>
                <p><strong>Data da Avaliação:</strong> <?= htmlspecialchars($dadosAvaliacao['data_avaliacao']) ?></p>
                <p><strong>Queixa Principal:</strong> <?= htmlspecialchars($dadosAvaliacao['queixa_principal']) ?></p>
                <p><strong>Outras Queixas:</strong> <?= htmlspecialchars($dadosAvaliacao['comorbidades']) ?></p>
                <p><strong>Outras Queixas:</strong> <?= htmlspecialchars($dadosAvaliacao['medicamentos_uso_continuo']) ?></p>
                <p><strong>Outras Queixas:</strong> <?= htmlspecialchars($dadosAvaliacao['medicamentos_atuais']) ?></p>
                <p><strong>Outras Queixas:</strong> <?= htmlspecialchars($dadosAvaliacao['tratamentos_complementares']) ?></p>
                <p><strong>Outras Queixas:</strong> <?= htmlspecialchars($dadosAvaliacao['diagnostico_clinico']) ?></p>
                <p><strong>Outras Queixas:</strong> <?= htmlspecialchars($dadosAvaliacao['cid']) ?></p>
                <p><strong>Outras Queixas:</strong> <?= htmlspecialchars($dadosAvaliacao['historia_doenca_atual']) ?></p>
                <p><strong>Outras Queixas:</strong> <?= htmlspecialchars($dadosAvaliacao['historia_doenca_pregressa']) ?></p>
                <p><strong>Outras Queixas:</strong> <?= htmlspecialchars($dadosAvaliacao['antecedentes_cirurgicos']) ?></p>
                <p><strong>Outras Queixas:</strong> <?= htmlspecialchars($dadosAvaliacao['atividades_afetadas']) ?></p>
                <p><strong>Outras Queixas:</strong> <?= htmlspecialchars($dadosAvaliacao['fatores_ambientais']) ?></p>
                <p><strong>Outras Queixas:</strong> <?= htmlspecialchars($dadosAvaliacao['observacoes']) ?></p>
            </div>
            <hr>

            <div class="data-section">
                <h3>Avaliação Física</h3>
                <p><strong>Postura Cabeça:</strong> <?= htmlspecialchars($dadosAvaliacaoFisica['postura_cabeca']) ?></p>
                <p><strong>Postura Clavicula:</strong> <?= htmlspecialchars($dadosAvaliacaoFisica['postura_clavicula']) ?></p>
                <p><strong>Postura Ombro:</strong> <?= htmlspecialchars($dadosAvaliacaoFisica['postura_ombro']) ?></p>
                <p><strong>Postura Cotovelo:</strong> <?= htmlspecialchars($dadosAvaliacaoFisica['postura_cotovelo']) ?></p>
                <p><strong>Postura Antebraço:</strong> <?= htmlspecialchars($dadosAvaliacaoFisica['postura_antebraco']) ?></p>
                <p><strong>Postura Mãos:</strong> <?= htmlspecialchars($dadosAvaliacaoFisica['postura_maos']) ?></p>
                <p><strong>Postura Eias:</strong> <?= htmlspecialchars($dadosAvaliacaoFisica['postura_eias']) ?></p>
                <p><strong>Postura Joelhos:</strong> <?= htmlspecialchars($dadosAvaliacaoFisica['postura_joelhos']) ?></p>
                <p><strong>Postura Tornozelos:</strong> <?= htmlspecialchars($dadosAvaliacaoFisica['postura_tornozelos']) ?></p>
                <p><strong>Postura Patelas:</strong> <?= htmlspecialchars($dadosAvaliacaoFisica['postura_patelas']) ?></p>
                <p><strong>Inspeção Palpação:</strong> <?= htmlspecialchars($dadosAvaliacaoFisica['inspecao_palapacao']) ?></p>
                <p><strong>Postura Coluna Toracica:</strong> <?= htmlspecialchars($dadosAvaliacaoFisica['postura_coluna_toracica']) ?></p>
                <p><strong>Postura Coluna Cervical:</strong> <?= htmlspecialchars($dadosAvaliacaoFisica['postura_coluna_cervical']) ?></p>
                <p><strong>Postura Coluna Lombar:</strong> <?= htmlspecialchars($dadosAvaliacaoFisica['postura_coluna_lombar']) ?></p>
            </div>
            <hr>

            <div class="data-section">
                <h3>Força Muscular</h3>
                <p><strong>Grau de Força:</strong> <?= htmlspecialchars($dadosForcaMuscular['grau_forca']) ?></p>
            </div>
            <hr>
            <div class="data-section">

         <h3>Perimetria</h3>
         <?php if (!empty($dadosPerimetria)): ?>
              <?php foreach ($dadosPerimetria as $perimetria): ?>
                  <p><strong>Região:</strong> <?= isset($perimetria['regiao']) ? htmlspecialchars($perimetria['regiao']) : 'Não informado' ?></p>
                  <p><strong>Medida 1:</strong> <?= isset($perimetria['medida_1']) ? htmlspecialchars($perimetria['medida_1']) : 'Não informado' ?></p>
                   <p><strong>Medida 2:</strong> <?= isset($perimetria['medida_2']) ? htmlspecialchars($perimetria['medida_2']) : 'Não informado' ?></p>
                   <p><strong>Medida 3:</strong> <?= isset($perimetria['medida_3']) ? htmlspecialchars($perimetria['medida_3']) : 'Não informado' ?></p>
                <?php endforeach; ?>
         <?php else: ?>
                <p>Nenhuma informação de perimetria encontrada.</p>
            <?php endif; ?>
        </div>

        <div class="data-section">
          <h3>Sensibilidade</h3>
           <?php if (!empty($dadosSensibilidade)): ?>
             <?php foreach ($dadosSensibilidade as $sensibilidade): ?>
                  <p><strong>Local:</strong> <?= isset($sensibilidade['local']) ? htmlspecialchars($sensibilidade['local']) : 'Não informado' ?></p>
                  <p><strong>Sensibilidade Tátil Direito:</strong> <?= isset($sensibilidade['sensibilidade_tatil_direito']) ? htmlspecialchars($sensibilidade['sensibilidade_tatil_direito']) : 'Não informado' ?></p>
                   <p><strong>Sensibilidade Tátil Esquerdo:</strong> <?= isset($sensibilidade['sensibilidade_tatil_esquerdo']) ? htmlspecialchars($sensibilidade['sensibilidade_tatil_esquerdo']) : 'Não informado' ?></p>
                    <p><strong>Sensibilidade Dolorosa Direito:</strong> <?= isset($sensibilidade['sensibilidade_dolorosa_direito']) ? htmlspecialchars($sensibilidade['sensibilidade_dolorosa_direito']) : 'Não informado' ?></p>
                    <p><strong>Sensibilidade Dolorosa Esquerdo:</strong> <?= isset($sensibilidade['sensibilidade_dolorosa_esquerdo']) ? htmlspecialchars($sensibilidade['sensibilidade_dolorosa_esquerdo']) : 'Não informado' ?></p>
                    <p><strong>Sensibilidade Térmica Direito:</strong> <?= isset($sensibilidade['sensibilidade_termica_direito']) ? htmlspecialchars($sensibilidade['sensibilidade_termica_direito']) : 'Não informado' ?></p>
                 <p><strong>Sensibilidade Térmica Esquerdo:</strong> <?= isset($sensibilidade['sensibilidade_termica_esquerdo']) ? htmlspecialchars($sensibilidade['sensibilidade_termica_esquerdo']) : 'Não informado' ?></p>
              <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhuma informação de sensibilidade encontrada.</p>
         <?php endif; ?>
        </div>

        <div class="data-section">
           <h3>Testes Especiais</h3>
          <?php if (!empty($dadosTestesEspeciais)): ?>
                <?php foreach ($dadosTestesEspeciais as $teste): ?>
                 <p><strong>Descrição:</strong> <?= isset($teste['descricao']) ? htmlspecialchars($teste['descricao']) : 'Não informado' ?></p>
                <?php endforeach; ?>
          <?php else: ?>
              <p>Nenhum teste especial encontrado.</p>
           <?php endif; ?>
    </div>


        <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
            <p>Nenhuma avaliação encontrada com o ID informado.</p>
        <?php endif; ?>
    </main>
</body>
</html>
