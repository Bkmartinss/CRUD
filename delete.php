<?php
include 'db/Usuario.php';

$usuario = new Usuario($pdo); // Passando a conexão para a classe

// se tipo POST 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // remover
    $usuario->delete($_POST['id']);
    
    // redireciona
    header('Location: index.php'); 
    exit; 
}
?>
