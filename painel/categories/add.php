<?php
session_start();
include 'C:/xampp/htdocs/Lucas/bd/conexao.php'; // Inclua o arquivo de conexão

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $name = $_POST['name'];
    $description = $_POST['description'];
    $icon = $_POST['icon'];

    // Valida os dados
    if (empty($name)) {
        $_SESSION['message'] = "Category name is required.";
        header("Location: index.php"); // Redirecione para a página desejada
        exit();
    }

    // Prepara e executa a inserção
    $sql = "INSERT INTO categories (name, description, icon) VALUES (?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $name, $description, $icon);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Category added successfully!";
        } else {
            $_SESSION['message'] = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['message'] = "Error preparing statement: " . $conn->error;
    }

    $conn->close();
    
    // Redireciona para a página desejada
    header("Location: index.php");
    exit();
} else {
    // Redireciona para a página desejada se o acesso não for feito via POST
    header("Location: index.php");
    exit();
}
?>
