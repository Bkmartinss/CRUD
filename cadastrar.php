<?php

include 'db/Usuario.php';

$usuario = new Usuario($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // dados armazena em um array
    $data = [
        'nome' => $_POST['nome'],
        'email' => $_POST['email'],
        'cpf' => $_POST['cpf']
    ];

    //  inserir os dados no banco
    $result = $usuario->create($data);

    //  mensagem datraves de um alert
    echo "<script>alert('" . $result['message'] . "');</script>";

    // redireciona para a lista de usuários
    if ($result['success']) {
        header("Location: index.php");
        exit; // Interrompe a execução após o redirecionamento para evitar que o código continue a ser executado
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Usuário</title>    
    <!-- CSS do Bootstrap -->
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
        <h1>Cadastrar Usuário</h1>
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" name="cpf" required>
            </div>
            <button type="submit" class="btn btn-success">Cadastrar</button>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
    <div id="rodape">
        <?php include "todo/rodape.php"?>
    </div>
</body>
</html>
