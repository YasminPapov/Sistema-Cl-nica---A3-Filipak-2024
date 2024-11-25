<?php
require 'config.php'; 
session_start();

/**
 * 
 *
 * @param string 
 * @return int 
 */
function calcularIdade($data_nascimento) {
    $data_nascimento = new DateTime($data_nascimento);
    $data_atual = new DateTime(); 
    return $data_nascimento->diff($data_atual)->y; 
}

$idade_calculada = null;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
       
        $data_nascimento = $_POST['data_nascimento'];
        $idade_calculada = calcularIdade($data_nascimento);

        $dados = [
            'nome' => $_POST['nome'],
            'endereco' => $_POST['endereco'],
            'peso' => $_POST['peso'] ?? null,
            'altura' => $_POST['altura'] ?? null,
            'data_nascimento' => $data_nascimento,
            'idade' => $idade_calculada, 
            'genero' => $_POST['genero'],
            'estado_civil' => $_POST['estado_civil'],
            'numero_gestacoes' => $_POST['numero_gestacoes'] ?? null,
            'numero_filhos' => $_POST['numero_filhos'] ?? null,
            'tipo_parto' => $_POST['tipo_parto'],
            'nivel_escolaridade' => $_POST['nivel_escolaridade'],
            'profissao' => $_POST['profissao'],
            'ocupacao' => $_POST['ocupacao'],
            'condicao_fisica' => $_POST['condicao_fisica'],
            'tabagista' => $_POST['tabagista'],
            'etilista' => $_POST['etilista']
        ];

    
        $sql = "INSERT INTO paciente 
                (nome, endereco, peso, altura, data_nascimento, idade, genero, estado_civil, 
                numero_gestacoes, numero_filhos, tipo_parto, nivel_escolaridade, profissao, 
                ocupacao, condicao_fisica, tabagista, etilista) 
                VALUES 
                (:nome, :endereco, :peso, :altura, :data_nascimento, :idade, :genero, :estado_civil, 
                :numero_gestacoes, :numero_filhos, :tipo_parto, :nivel_escolaridade, :profissao, 
                :ocupacao, :condicao_fisica, :tabagista, :etilista)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($dados);

        echo "<p style='color: green; text-align: center;'>Paciente cadastrado com sucesso!</p>";
    } catch (Exception $e) {
        echo "<p style='color: red; text-align: center;'>Erro ao cadastrar paciente: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Paciente</title>
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
            gap: 20px; /* Espaço entre os itens */
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
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" required>

            <label for="endereco">Endereço</label>
            <textarea id="endereco" name="endereco" rows="3"></textarea>

            <label for="peso">Peso (kg)</label>
            <input type="number" step="0.01" id="peso" name="peso">

            <label for="altura">Altura (m)</label>
            <input type="number" step="0.01" id="altura" name="altura">

            <label for="data_nascimento">Data de Nascimento</label>
            <input type="date" id="data_nascimento" name="data_nascimento" required>

            <label for="genero">Gênero</label>
            <select id="genero" name="genero" required>
                <option value="">Selecione</option>
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
                <option value="Outro">Outro</option>
            </select>

            <label for="estado_civil">Estado Civil</label>
            <select id="estado_civil" name="estado_civil" required>
                <option value="">Selecione</option>
                <option value="Solteiro">Solteiro</option>
                <option value="Compromissado">Compromissado</option>
            </select>

            <label for="numero_gestacoes">Número de Gestações</label>
            <input type="number" id="numero_gestacoes" name="numero_gestacoes">

            <label for="numero_filhos">Número de Filhos</label>
            <input type="number" id="numero_filhos" name="numero_filhos">

            <label for="tipo_parto">Tipo de Parto</label>
            <select id="tipo_parto" name="tipo_parto" required>
                <option value="">Selecione</option>
                <option value="Cesárea">Nenhum</option>
                <option value="Cesárea">Cesárea</option>
                <option value="Normal">Normal</option>
            </select>

            <label for="nivel_escolaridade">Nível de Escolaridade</label>
            <select id="nivel_escolaridade" name="nivel_escolaridade" required>
                <option value="">Selecione</option>
                <option value="Superior">Superior</option>
                <option value="Médio">Médio</option>
                <option value="Fundamental">Fundamental</option>
                <option value="Nenhum">Nenhum</option>
            </select>

            <label for="profissao">Profissão</label>
            <input type="text" id="profissao" name="profissao">

            <label for="ocupacao">Ocupação</label>
            <input type="text" id="ocupacao" name="ocupacao">

            <label for="condicao_fisica">Condição Física</label>
            <select id="condicao_fisica" name="condicao_fisica" required>
                <option value="">Selecione</option>
                <option value="Normal">Atividade de nivel elevado</option>
                <option value="Normal">Normal</option>
                <option value="Sedentário">Sedentário</option>
            </select>

            <label for="tabagista">Tabagista</label>
            <select id="tabagista" name="tabagista">
                <option value="">Selecione</option>
                <option value="Sim">Sim</option>
                <option value="Não">Não</option>
            </select>

            <label for="etilista">Etilista</label>
            <select id="etilista" name="etilista">
                <option value="">Selecione</option>
                <option value="Sim">Sim</option>
                <option value="Não">Não</option>
            </select>

            <button type="submit">Cadastrar</button>
        </form>

        <?php