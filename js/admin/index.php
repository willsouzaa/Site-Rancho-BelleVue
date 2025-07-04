<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['senha'] === 'Anarancho') {
    $_SESSION['logado'] = true;
    header('Location: calendario.php');
    exit;
}
?>
<form method="post">
    <input type="password" name="senha" placeholder="Senha" required>
    <button type="submit">Entrar</button>
</form>
