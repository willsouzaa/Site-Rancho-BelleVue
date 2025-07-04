<?php
session_start();
if (!isset($_SESSION['logado'])) die("Acesso negado");

$conn = new mysqli("localhost", "rachobel_rancho", "@Will2015", "rachobel_Calendario");

$acao = $_POST['acao'] ?? '';

if ($acao === "adicionar") {
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];
    $hora_entrada = $_POST['hora_entrada'] ?: null;
    $hora_saida = $_POST['hora_saida'] ?: null;
    $obs = $_POST['obs'] ?? '';

    $stmt = $conn->prepare("INSERT INTO datas_alugadas (data_inicio, data_fim, hora_entrada, hora_saida, observacao) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $data_inicio, $data_fim, $hora_entrada, $hora_saida, $obs);
    $stmt->execute();
} elseif ($acao === "remover") {
    $id = $_POST['id'] ?? 0;
    $stmt = $conn->prepare("DELETE FROM datas_alugadas WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: calendario.php");
exit;
?>
