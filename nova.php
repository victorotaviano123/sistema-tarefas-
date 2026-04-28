<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];

    $stmt = $pdo->prepare("INSERT INTO tarefas (titulo, descricao, usuario_id) VALUES (?,?,?)");
    $stmt->execute([$titulo, $descricao, $_SESSION["usuario_id"]]);

    header("Location: index.php");
    exit;
}

include "layout.php";
?>

<h3>Nova Tarefa</h3>

<form method="POST">
<input class="form-control mb-2" name="titulo" required placeholder="Título">
<textarea class="form-control mb-2" name="descricao"></textarea>
<button class="btn btn-success">Salvar</button>
</form>

</div></body></html>