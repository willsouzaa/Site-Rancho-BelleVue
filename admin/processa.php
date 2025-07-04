<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['logado'])) {
    die("Acesso negado");
}

$conn = new mysqli("localhost", "rachobel_rancho", "@Will2015", "rachobel_Calendario");
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$acao = $_POST['acao'] ?? '';

if ($acao === "adicionar") {
    $data_inicio = $_POST['data_inicio'] ?? null;
    $data_fim = $_POST['data_fim'] ?? null;
    $obs = $_POST['obs'] ?? '';

    if ($data_inicio && $data_fim) {
        $stmt = $conn->prepare("INSERT INTO datas_alugadas (data_inicio, data_fim, observacao) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $data_inicio, $data_fim, $obs);
        $stmt->execute();
        $stmt->close();
    } else {
        die("Datas inválidas");
    }
} elseif ($acao === "remover") {
    $id = $_POST['id'] ?? 0;
    $stmt = $conn->prepare("DELETE FROM datas_alugadas WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: calendario.php");
exit;
