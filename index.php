<?php

include 'db/Usuario.php';

// cria uma instância e passa a conexão PDO como argumento
$usuario = new Usuario($pdo);
// buscar todos
$usuarios = $usuario->all(); 
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>CRUD de Usuários</title>

    <!-- Link p CSS do Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- jQuery para manipulação de eventos -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <link rel="stylesheet" href="css/styles.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="js/script.js"></script>
</head>
<body>
    <div id="topo">
        <?php include "todo/topo.php"?>
    </div>
    <div class="container">
        <h1>Lista de Usuários</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>CPF</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- exibe suas informações em uma linha da tabela -->
                <?php foreach ($usuarios as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['nome']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['cpf']) ?></td>
                        <td><?= htmlspecialchars($user['status']) ?></td>
                        <td>
                            <a href="editar.php?id=<?= $user['id'] ?>" class="btn btn-warning">Editar</a>
                            <button class="btn btn-danger delete" data-id="<?= $user['id'] ?>">Remover</button>
                            <!-- ativar/inativar o usuário, alterando o texto com base no status atual -->
                            <button class="btn btn-secondary toggle-status" data-id="<?= $user['id'] ?>">
                                <?= $user['status'] === 'ativo' ? 'Inativar' : 'Ativar' ?>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- botão p formulário de cadastro  -->
        <a href="cadastrar.php" class="btn btn-primary ">Cadastrar Usuário</a>
    </div>
    <div id="rodape">
        <?php include "todo/rodape.php"?>
    </div>
</body>
</html>
