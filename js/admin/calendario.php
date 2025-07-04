<?php
session_start();
if (!isset($_SESSION['logado'])) die("Acesso negado");

$conn = new mysqli("localhost", "rachobel_rancho", "@Will2015", "rachobel_Calendario");
$datas = $conn->query("SELECT * FROM datas_alugadas ORDER BY data");
?>

<h2>Datas Alugadas</h2>
<form action="processa.php" method="post">
    <input type="date" name="data" required>
    <input type="text" name="obs" placeholder="Observação (opcional)">
    <button type="submit" name="acao" value="adicionar">Adicionar</button>
</form>

<ul>
<?php while ($row = $datas->fetch_assoc()): ?>
    <li><?= $row['data'] ?> - <?= $row['observacao'] ?>
        <form action="processa.php" method="post" style="display:inline">
            <input type="hidden" name="data" value="<?= $row['data'] ?>">
            <button type="submit" name="acao" value="remover">Remover</button>
        </form>
    </li>
<?php endwhile; ?>
</ul>
