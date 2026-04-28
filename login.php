<?php
session_start();
include "conexao.php";

$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha = md5($_POST["senha"]);

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario=? AND senha=?");
    $stmt->execute([$usuario, $senha]);

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch();

        $_SESSION["usuario_id"] = $user["id"];
        $_SESSION["usuario"] = $user["usuario"];

        header("Location: index.php");
        exit;
    } else {
        $erro = "Usuário ou senha inválidos!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">
<div class="card p-4 col-md-4 mx-auto">

<h3 class="text-center">Login</h3>

<?php if($erro): ?>
<div class="alert alert-danger"><?= $erro ?></div>
<?php endif; ?>

<form method="POST">
<input class="form-control mb-2" name="usuario" required placeholder="Usuário">
<input class="form-control mb-2" type="password" name="senha" required placeholder="Senha">
<button class="btn btn-primary w-100">Entrar</button>
</form>

</div>
</div>
</body>
</html>