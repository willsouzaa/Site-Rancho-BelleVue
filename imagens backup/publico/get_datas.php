<?php
header('Content-Type: application/json');
$conn = new mysqli("localhost", "rachobel_rancho", "@Will2015", "rachobel_Calendario");

if ($conn->connect_error) {
    echo json_encode([]);
    exit;
}

$res = $conn->query("SELECT data_inicio, data_fim, observacao FROM datas_alugadas");
$eventos = [];

while ($row = $res->fetch_assoc()) {
    $start = $row['data_inicio'];
    $end = $row['data_fim'] ?? $start;
    $eventos[] = [
        "title" => "Indisponível",
        "start" => $start,
        "end" => date('Y-m-d', strtotime($end . ' +1 day')), // FullCalendar considera end exclusivo
        "allDay" => true,
        "color" => "#ff0000",
        "description" => $row['observacao']
    ];
}

echo json_encode($eventos);
?>
