<?php
// Definindo as variáveis de conexão
$servername = "localhost";
$username = "root"; // Usuário do banco de dados
$password = ""; // Senha do banco de dados
$dbname = "news"; // Nome do banco de dados

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Definindo o charset da conexão (opcional, mas recomendado)
$conn->set_charset("utf8mb4");

// A conexão está pronta para ser usada em outros arquivos
?>
