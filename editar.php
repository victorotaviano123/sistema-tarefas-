<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

include "conexao.php";

$id = $_GET["id"];

$stmt = $pdo->prepare("SELECT * FROM tarefas WHERE id=? AND usuario_id=?");
$stmt->execute([$id, $_SESSION["usuario_id"]]);
$tarefa = $stmt->fetch();

if (!$tarefa) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $status = $_POST["status"];

    $stmt = $pdo->prepare("UPDATE tarefas SET titulo=?, descricao=?, status=? WHERE id=? AND usuario_id=?");
    $stmt->execute([$titulo, $descricao, $status, $id, $_SESSION["usuario_id"]]);

    header("Location: index.php");
    exit;
}

include "layout.php";
?>

<h3>Editar</h3>

<form method="POST">
<input class="form-control mb-2" name="titulo" value="<?= $tarefa["titulo"] ?>">
<textarea class="form-control mb-2" name="descricao"><?= $tarefa["descricao"] ?></textarea>

<select name="status" class="form-control mb-2">
<option value="pendente" <?= $tarefa["status"]=="pendente"?"selected":"" ?>>Pendente</option>
<option value="concluida" <?= $tarefa["status"]=="concluida"?"selected":"" ?>>Concluída</option>
</select>

<button class="btn btn-primary">Atualizar</button>
</form>

</div></body></html>