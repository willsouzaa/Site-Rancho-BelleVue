<?php
session_start();
if (!isset($_SESSION['logado'])) die("Acesso negado");

$conn = new mysqli("localhost", "rachobel_rancho", "@Will2015", "rachobel_Calendario");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$datas = $conn->query("SELECT * FROM datas_alugadas ORDER BY data_inicio");

?>

<h2>Datas Alugadas</h2>
<form action="processa.php" method="post">
    <input type="date" name="data_inicio" required>
    <input type="date" name="data_fim" required>
    <input type="text" name="obs" placeholder="Observação (opcional)">
    <button type="submit" name="acao" value="adicionar">Adicionar</button>
</form>

<ul>
<?php while ($row = $datas->fetch_assoc()): ?>
    <li><?= date('d/m/Y', strtotime($row['data_inicio'])) ?> até <?= date('d/m/Y', strtotime($row['data_fim'])) ?> - <?= htmlspecialchars($row['observacao']) ?>
        <form action="processa.php" method="post" style="display:inline">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <button type="submit" name="acao" value="remover">Remover</button>
        </form>
    </li>
<?php endwhile; ?>
</ul>
