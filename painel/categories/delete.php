<?php
include 'C:/xampp/htdocs/Lucas/bd/conexao.php'; // Inclui a conexão ao banco de dados

// Verifica se o ID foi passado pela URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verifica se o formulário foi enviado para confirmar a exclusão
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Exclui a categoria do banco de dados
        $deleteQuery = "DELETE FROM categories WHERE id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Categoria deletada com sucesso.";
            // Redireciona para a página de listagem após a exclusão
            header("Location: index.php");
            exit;
        } else {
            echo "Erro ao deletar a categoria: " . $conn->error;
        }
    }
} else {
    echo "ID da categoria não fornecido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Categoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Deletar Categoria</h2>
        <p>Tem certeza de que deseja deletar esta categoria?</p>
        <form method="post">
            <button type="submit" class="btn btn-danger">Sim, deletar</button>
            <a href="categories.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
