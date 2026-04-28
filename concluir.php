<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

include "conexao.php";

$id = $_GET["id"];

$stmt = $pdo->prepare("UPDATE tarefas SET status='concluida' WHERE id=? AND usuario_id=?");
$stmt->execute([$id, $_SESSION["usuario_id"]]);

header("Location: index.php");
exit;