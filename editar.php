<?php

include 'db/Usuario.php';

$usuario = new Usuario($pdo); // Passando a conexão para a classe

// usuário com base no ID
$user = $usuario->find($_GET['id']);

// verifica se é do tipo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // atualizar os dados do usuário
    $usuario->update($_GET['id'], $_POST);
    // lista de usuários
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    
    <!--  CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/styles.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>
    <body>
        <div id="topo">
            <?php include "todo/topo.php"?>
        </div>
        <div class="container">
            <h1>Editar Usuário</h1>
            <form method="POST">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" value="<?= htmlspecialchars($user['nome']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control" name="cpf" value="<?= htmlspecialchars($user['cpf']) ?>" required>
                </div>
                <button type="submit" class="btn btn-success">Salvar</button>
                <!-- Botão para voltar à lista de usuários -->
                <a href="index.php" class="btn btn-secondary">Voltar</a>
            </form>
        </div>
    </body>
    <div id="rodape">
        <?php include "todo/rodape.php"?>
    </div>
</html>
