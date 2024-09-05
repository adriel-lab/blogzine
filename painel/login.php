<?php
session_start();
include 'C:/xampp/htdocs/Lucas/bd/conexao.php'; 
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta SQL para verificar se o usuário existe e está ativo
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND status = 'active'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Inicia sessão e define os detalhes do usuário
        $_SESSION['id'] = $user['id'];
        $_SESSION['user'] = $user['name'];
        $_SESSION['access_level'] = $user['access_level'];

        // Atualiza a data do último login
        $update_login_sql = "UPDATE users SET last_login = NOW() WHERE id = " . $user['id'];
        $conn->query($update_login_sql);

        //echo "Login bem-sucedido! Usuário: " . $_SESSION['user'] . " | Nível de Acesso: " . $_SESSION['access_level'];
        //echo '<br> id: '. $_SESSION['id'] ;

        header("Location: dashboard.php");
        exit(); // Garante que o script não continue após o redirecionamento

    } else {
        echo "Email ou senha incorretos, ou conta inativa.";
    }
}

$conn->close();
?>
