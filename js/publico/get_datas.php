<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "rachobel_rancho", "@Will2015", "rachobel_Calendario");

if ($conn->connect_error) {
    echo json_encode(["error" => "Erro ao conectar ao banco"]);
    exit;
}

$res = $conn->query("SELECT data FROM datas_alugadas");
$eventos = [];

while ($row = $res->fetch_assoc()) {
    $eventos[] = [
        "title" => "Indisponível",
        "start" => $row['data'],
        "allDay" => true,
        "color" => "#ff0000"
    ];
}
echo json_encode($eventos);
?>
