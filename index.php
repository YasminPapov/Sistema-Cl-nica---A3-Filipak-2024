<?php
session_start();
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
}
?>
<form method="POST" action="upload_documento.php" enctype="multipart/form-data">
    <select name="id_paciente">
    </select>
    <input type="file" name="arquivo" required>
    <button type="submit">Enviar</button>
</form>
