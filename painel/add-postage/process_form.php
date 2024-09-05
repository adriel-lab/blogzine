<?php
session_start();
include 'C:/xampp/htdocs/Lucas/bd/conexao.php'; 

// Dados do formulário
$name = $_POST['name'];
$short_description = $_POST['short_description'];
$post_body = $_POST['post_body'];
$tags = $_POST['tags'];
$category_id = $_POST['category_id'];
$featured = isset($_POST['featured']) ? 1 : 0;
$post_type = $_POST['post_type'];

// Inicializa a variável de status
$status = '';

// Inserindo dados na tabela de posts
$sql = "INSERT INTO posts (name, short_description, post_body, tags, category_id, featured, post_type) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssiis", $name, $short_description, $post_body, $tags, $category_id, $featured, $post_type);

if ($stmt->execute()) {
    $post_id = $stmt->insert_id; // ID do post inserido

    // Processando imagens
    $image_fields = ['cover_image', 'middle_image', 'body_image1', 'body_image2', 'body_image3'];
    $all_images_uploaded = true;

    foreach ($image_fields as $index => $field) {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] === 0) {
            $image_name = $_FILES[$field]['name'];
            $image_tmp_name = $_FILES[$field]['tmp_name'];
            $image_size = $_FILES[$field]['size'];
            $image_error = $_FILES[$field]['error'];
            $image_type = $_FILES[$field]['type'];

            // Gerar um nome único para a imagem
            $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
            $image_new_name = uniqid('', true) . '.' . $image_ext;
            $image_destination = 'uploads/' . $image_new_name;

            // Mover a imagem para o diretório de uploads
            if (move_uploaded_file($image_tmp_name, $image_destination)) {
                // Inserir informações da imagem na tabela de imagens
                $sql_image = "INSERT INTO images (post_id, image_path, image_type) VALUES (?, ?, ?)";
                $stmt_image = $conn->prepare($sql_image);
                $stmt_image->bind_param("iss", $post_id, $image_new_name, $field);
                $stmt_image->execute();
            } else {
                $all_images_uploaded = false;
                $_SESSION['error'] = "Erro ao fazer upload da imagem: " . $image_name;
                break;
            }
        } else {
            $all_images_uploaded = false;
            $_SESSION['error'] = "Erro ao processar o campo da imagem: " . $field;
            break;
        }
    }

    if ($all_images_uploaded) {
        $_SESSION['success'] = "Post inserido com sucesso. ID: " . $post_id;
    }
} else {
    $_SESSION['error'] = "Erro ao inserir post: " . $stmt->error;
}

$stmt->close();
$conn->close();

// Redireciona para a página de resultado
header("Location: index.php");
exit();
?>
