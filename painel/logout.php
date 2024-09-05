<?php
session_start();

// Verifica se o usuário está logado
if (isset($_SESSION['user'])) {
    // Destrói a sessão
    session_unset(); // Remove todas as variáveis de sessão
    session_destroy(); // Destrói a sessão

    // Redireciona para a página de login
    header("Location: index.php");
    exit(); // Garante que o script não continue após o redirecionamento
} else {
    // Se não há sessão ativa, redireciona para a página de login
    header("Location: index.php");
    exit();
}
?>
