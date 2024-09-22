<?php

include 'db/Usuario.php';

$usuario = new Usuario($pdo); // Passando a conexão para a classe

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // alternar o status
    $usuario->toggleStatus($_POST['id']);
    
    // redireciona 
    header('Location: index.php'); 
    exit; 
}
?>
