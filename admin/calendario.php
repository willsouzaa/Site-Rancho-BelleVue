<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['logado'])) die("Acesso negado");

$conn = new mysqli("localhost", "rachobel_rancho", "@Will2015", "rachobel_Calendario");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$datas = $conn->query("SELECT * FROM datas_alugadas ORDER BY data_inicio");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Gerenciar Datas Alugadas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js'></script>
  <style>
    body { padding: 30px; background:#f5f5f5; }
    .container { background: white; padding: 20px; border-radius: 8px; max-width: 900px; margin: auto; }
    #calendar { max-width: 900px; margin: 40px auto; }
  </style>
</head>
<body>
<div class="container">
  <h2 class="mb-4 text-center text-success">Gerenciar Datas Alugadas</h2>

  <form action="processa.php" method="post" class="row g-3 mb-4">
    <div class="col-md-4">
      <label for="data_inicio" class="form-label">Data de Início</label>
      <input type="date" name="data_inicio" id="data_inicio" class="form-control" required />
    </div>
    <div class="col-md-4">
      <label for="data_fim" class="form-label">Data de Término</label>
      <input type="date" name="data_fim" id="data_fim" class="form-control" required />
    </div>
    <div class="col-md-4">
      <label for="obs" class="form-label">Observações</label>
      <input type="text" name="obs" id="obs" class="form-control" placeholder="Ex: cliente já pagou" />
    </div>
    <div class="col-12 text-center">
      <button type="submit" name="acao" value="adicionar" class="btn btn-success">Adicionar Período</button>
    </div>
  </form>

  <h4>Lista de Reservas</h4>
  <ul class="list-group">
    <?php while ($row = $datas->fetch_assoc()): ?>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <?= date('d/m/Y', strtotime($row['data_inicio'])) ?> até <?= date('d/m/Y', strtotime($row['data_fim'])) ?> -
        <?= htmlspecialchars($row['observacao']) ?>
        <form action="processa.php" method="post" class="ms-3">
          <input type="hidden" name="id" value="<?= $row['id'] ?>" />
          <button type="submit" name="acao" value="remover" class="btn btn-sm btn-outline-danger">Remover</button>
        </form>
      </li>
    <?php endwhile; ?>
  </ul>

  <div id="calendar"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: 'get_datas.php',
        eventColor: '#ff0000',
        eventDisplay: 'block',
        eventDidMount: function(info) {
            if(info.event.extendedProps.description) {
                var tooltip = new Tooltip(info.el, {
                    title: info.event.extendedProps.description,
                    placement: 'top',
                    trigger: 'hover',
                    container: 'body'
                });
            }
        }
    });
    calendar.render();
});
</script>

<!-- Opcional: Tooltip depende do Bootstrap ou outra lib -->

</body>
</html>
