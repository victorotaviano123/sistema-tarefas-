<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

include "conexao.php";
include "layout.php";

$stmt = $pdo->prepare("SELECT * FROM tarefas WHERE usuario_id=?");
$stmt->execute([$_SESSION["usuario_id"]]);
$tarefas = $stmt->fetchAll();
?>

<h2>Minhas Tarefas</h2>

<a href="nova.php" class="btn btn-success mb-3">Nova Tarefa</a>

<table class="table table-bordered">
<tr>
<th>Título</th>
<th>Status</th>
<th>Data</th>
<th>Ações</th>
</tr>

<?php foreach ($tarefas as $t): ?>
<tr>
<td><?= $t["titulo"] ?></td>

<td>
<?php if($t["status"]=="concluida"): ?>
<span class="badge bg-success">Concluída</span>
<?php else: ?>
<span class="badge bg-warning text-dark">Pendente</span>
<?php endif; ?>
</td>

<td><?= $t["data_criacao"] ?></td>

<td>
<a href="editar.php?id=<?= $t["id"] ?>" class="btn btn-primary btn-sm">Editar</a>
<a href="concluir.php?id=<?= $t["id"] ?>" class="btn btn-success btn-sm">Concluir</a>
<a href="excluir.php?id=<?= $t["id"] ?>" class="btn btn-danger btn-sm">Excluir</a>
</td>
</tr>
<?php endforeach; ?>
</table>

</div></body></html>