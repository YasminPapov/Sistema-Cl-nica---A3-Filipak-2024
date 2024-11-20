<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data_avaliacao = $_POST['data_avaliacao'];
    $queixa_principal = $_POST['queixa_principal'];
    $comorbidades = $_POST['comorbidades'];
    $medicamentos_uso_continuo = $_POST['medicamentos_uso_continuo'];
    $diagnostico_clinico = $_POST['diagnostico_clinico'];

    $sql = "INSERT INTO avaliacao (data_avaliacao, queixa_principal, comorbidades, medicamentos_uso_continuo, diagnostico_clinico) 
            VALUES ('$data_avaliacao', '$queixa_principal', '$comorbidades', '$medicamentos_uso_continuo', '$diagnostico_clinico')";

    if ($conn->query($sql) === TRUE) {
        echo "Nova avaliação adicionada com sucesso!";
    } else {
        echo "Erro ao adicionar avaliação: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Nova Avaliação</title>
</head>
<body>

<h1>Adicionar Nova Avaliação</h1>

<form method="post" action="add_avaliacao.php">
    <label for="data_avaliacao">Data da Avaliação:</label><br>
    <input type="date" id="data_avaliacao" name="data_avaliacao" required><br><br>

    <label for="queixa_principal">Queixa Principal:</label><br>
    <textarea id="queixa_principal" name="queixa_principal" required></textarea><br><br>

    <label for="comorbidades">Comorbidades:</label><br>
    <textarea id="comorbidades" name="comorbidades"></textarea><br><br>

    <label for="medicamentos_uso_continuo">Medicamentos de Uso Contínuo:</label><br>
    <textarea id="medicamentos_uso_continuo" name="medicamentos_uso_continuo"></textarea><br><br>

    <label for="diagnostico_clinico">Diagnóstico Clínico:</label><br>
    <textarea id="diagnostico_clinico" name="diagnostico_clinico" required></textarea><br><br>

    <input type="submit" value="Adicionar Avaliação">
</form>

</body>
</html>
