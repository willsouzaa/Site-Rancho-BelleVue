<?php
session_start();
if (!isset($_SESSION['logado'])) die("Acesso negado");

$conn = new mysqli("localhost", "rachobel_rancho", "@Will2015", "rachobel_Calendario");

$data = $_POST['data'];
$obs = $_POST['obs'] ?? '';
$acao = $_POST['acao'];

if ($acao === "adicionar") {
    $stmt = $conn->prepare("INSERT IGNORE INTO datas_alugadas (data, observacao) VALUES (?, ?)");
    $stmt->bind_param("ss", $data, $obs);
    $stmt->execute();
} elseif ($acao === "remover") {
    $stmt = $conn->prepare("DELETE FROM datas_alugadas WHERE data = ?");
    $stmt->bind_param("s", $data);
    $stmt->execute();
}

header("Location: calendario.php");
