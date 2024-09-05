<?php
// Incluindo a conexão com o banco de dados
include 'C:/xampp/htdocs/Lucas/bd/conexao.php';

// Verificando se o ID foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Preparando a consulta para buscar a categoria pelo ID
    $query = "SELECT * FROM categories WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificando se a categoria existe
    if ($result->num_rows > 0) {
        $category = $result->fetch_assoc();
    } else {
        echo "Categoria não encontrada.";
        exit();
    }
} else {
    echo "ID de categoria não especificado.";
    exit();
}

// Se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Atualiza a categoria no banco de dados
    $updateQuery = "UPDATE categories SET name = ?, description = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssii", $name, $description, $status, $id);

    if ($stmt->execute()) {
        echo "Categoria atualizada com sucesso.";
    } else {
        echo "Erro ao atualizar a categoria: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Editar Categoria</h2>
    <form method="POST" action="edit.php?id=<?php echo $id; ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($category['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($category['description']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="icon" class="form-label">Ícone</label>
            <input type="text" class="form-control" id="icon" name="icon" value="<?php echo htmlspecialchars($category['icon']); ?>" required>
        </div>
        <a class="btn btn-primary" href="index.php">Voltar</a>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
