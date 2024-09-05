<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">



<head>
    <title>News - Blog and Magazine Bootstrap 5 Theme</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="News.com">
    <meta name="description" content="Bootstrap based News, Magazine and Blog Theme">

    <!-- Dark mode -->
    <script>
        const storedTheme = localStorage.getItem('theme')

        const getPreferredTheme = () => {
            if (storedTheme) {
                return storedTheme
            }
            return window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'light'
        }

        const setTheme = function(theme) {
            if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.setAttribute('data-bs-theme', 'dark')
            } else {
                document.documentElement.setAttribute('data-bs-theme', theme)
            }
        }

        setTheme(getPreferredTheme())

        window.addEventListener('DOMContentLoaded', () => {
            var el = document.querySelector('.theme-icon-active');
            if (el != 'undefined' && el != null) {
                const showActiveTheme = theme => {
                    const activeThemeIcon = document.querySelector('.theme-icon-active use')
                    const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
                    const svgOfActiveBtn = btnToActive.querySelector('.mode-switch use').getAttribute('href')

                    document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
                        element.classList.remove('active')
                    })

                    btnToActive.classList.add('active')
                    activeThemeIcon.setAttribute('href', svgOfActiveBtn)
                }

                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                    if (storedTheme !== 'light' || storedTheme !== 'dark') {
                        setTheme(getPreferredTheme())
                    }
                })

                showActiveTheme(getPreferredTheme())

                document.querySelectorAll('[data-bs-theme-value]')
                    .forEach(toggle => {
                        toggle.addEventListener('click', () => {
                            const theme = toggle.getAttribute('data-bs-theme-value')
                            localStorage.setItem('theme', theme)
                            setTheme(theme)
                            showActiveTheme(theme)
                        })
                    })

            }
        })
    </script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../../assets/images/favicon.ico">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700&amp;family=Rubik:wght@400;500;700&amp;display=swap" rel="stylesheet">

    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="../../assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="../../assets/vendor/apexcharts/css/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="../../assets/vendor/quill/css/quill.snow.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">

</head>

<body>

    <!-- =======================
Header START -->
    <?php include '../../pages/header.php';  ?>
    <!-- =======================
Header END -->

    <!-- **************** MAIN CONTENT START **************** -->
    <main>

        <!-- =======================
Post edit START -->
        <section class="py-4">
            <div class="container">
                <div class="row pb-4">
                    <div class="col-12">
                        <!-- Title -->
                        <h1 class="mb-0 h2">Add post</h1>
                    </div>
                </div>

                <div class="container mt-4">

                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- Chart START -->
                        <div class="card border h-100">
                            <!-- Card body -->
                            <div class="card-body">
                                <!-- Form START -->
                                <?php
                                include 'C:/xampp/htdocs/Lucas/bd/conexao.php'; // Inclui a conexão ao banco de dados

                                // Verifica se o ID do post foi passado pela URL
                                if (isset($_GET['id'])) {
                                    $id = $_GET['id'];

                                    // Verifica se o formulário foi enviado para atualizar ou deletar
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        if (isset($_POST['update'])) {
                                            // Atualiza o post no banco de dados
                                            $name = $_POST['name'];
                                            $post_type = $_POST['post_type'];
                                            $short_description = $_POST['short_description'];
                                            $post_body = $_POST['post_body'];
                                            $category_id = $_POST['category_id'];
                                            $featured = isset($_POST['featured']) ? 1 : 0;

                                            // Atualiza dados do post
                                            $updateQuery = "UPDATE posts SET name = ?, post_type = ?, short_description = ?, post_body = ?, category_id = ?, featured = ? WHERE id = ?";
                                            $stmt = $conn->prepare($updateQuery);
                                            $stmt->bind_param("ssssiii", $name, $post_type, $short_description, $post_body, $category_id, $featured, $id);

                                            if ($stmt->execute()) {


                                                // Processa novas imagens
                                                $image_fields = ['cover_image', 'middle_image', 'body_image1', 'body_image2', 'body_image3'];
                                                $all_images_uploaded = true;

                                                foreach ($image_fields as $field) {
                                                    if (isset($_FILES[$field]) && $_FILES[$field]['error'] === 0) {
                                                        $image_name = $_FILES[$field]['name'];
                                                        $image_tmp_name = $_FILES[$field]['tmp_name'];
                                                        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                                                        $image_new_name = uniqid('', true) . '.' . $image_ext;
                                                        $image_destination = 'uploads/' . $image_new_name;

                                                        // Mover a imagem para o diretório de uploads
                                                        if (move_uploaded_file($image_tmp_name, $image_destination)) {
                                                            // Inserir informações da imagem na tabela de imagens
                                                            $sql_image = "INSERT INTO images (post_id, image_path, image_type) VALUES (?, ?, ?)";
                                                            $stmt_image = $conn->prepare($sql_image);
                                                            $stmt_image->bind_param("iss", $id, $image_new_name, $field);
                                                            $stmt_image->execute();
                                                        } else {
                                                            $all_images_uploaded = false;
                                                            echo "Erro ao fazer upload da imagem: " . $image_name;
                                                            break;
                                                        }
                                                    }
                                                }

                                                if ($all_images_uploaded) {
                                                    echo "Post atualizado com sucesso.";
                                                    echo '<script>window.location.href = "edit.php?id=' . htmlspecialchars($id) . '";</script>';
                                                }

                                                // Redireciona para a página de listagem após a atualização

                                                exit;
                                            } else {
                                                echo "Erro ao atualizar o post: " . $conn->error;
                                            }
                                        } elseif (isset($_POST['delete'])) {
                                            // Deleta o post do banco de dados
                                            $deleteQuery = "DELETE FROM posts WHERE id = ?";
                                            $stmt = $conn->prepare($deleteQuery);
                                            $stmt->bind_param("i", $id);

                                            if ($stmt->execute()) {
                                                echo "Post deletado com sucesso.";
                                                // Redireciona para a página de listagem após a exclusão


                                                exit;
                                            } else {
                                                echo "Erro ao deletar o post: " . $conn->error;
                                            }
                                        }
                                    }

                                    // Obtém os dados atuais do post para pré-preencher o formulário
                                    $selectQuery = "SELECT * FROM posts WHERE id = ?";
                                    $stmt = $conn->prepare($selectQuery);
                                    $stmt->bind_param("i", $id);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $post = $result->fetch_assoc();
                                    // Obtém as imagens associadas ao post
                                    $sql_images = "SELECT image_path, image_type FROM images WHERE post_id = ?";
                                    $stmt_images = $conn->prepare($sql_images);
                                    $stmt_images->bind_param("i", $id);
                                    $stmt_images->execute();
                                    $result_images = $stmt_images->get_result();
                                    $images = [];
                                    while ($row = $result_images->fetch_assoc()) {
                                        $images[$row['image_type']] = $row['image_path'];
                                    }
                                } else {
                                    echo "ID do post não fornecido.";
                                    exit;
                                }
                                ?>

                                <h2>Editar Post</h2>
                                <form action="edit.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Post name</label>
                                                <input required id="con-name" name="name" type="text" class="form-control" value="<?php echo htmlspecialchars($post['name']); ?>">
                                                <small>Moving heaven divide two sea female great midst spirit</small>
                                            </div>
                                        </div>
                                        <!-- Post type START -->
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Post type</label>
                                                <div class="d-flex flex-wrap gap-3">
                                                    <!-- Post type item -->
                                                    <div class="flex-fill">
                                                        <input type="radio" class="btn-check" value="Post" name="post_type" id="option" <?php if ($post['post_type'] == 'Post') echo 'checked'; ?>>
                                                        <label class="btn btn-outline-light w-100" for="option">
                                                            <i class="bi bi-chat-left-text fs-1"></i>
                                                            <span class="d-block"> Post </span>
                                                        </label>
                                                    </div>
                                                    <!-- Post type item -->
                                                    <div class="flex-fill">
                                                        <input type="radio" class="btn-check" value="Question" name="post_type" id="option2" <?php if ($post['post_type'] == 'Question') echo 'checked'; ?>>
                                                        <label class="btn btn-outline-light w-100" for="option2">
                                                            <i class="bi bi-patch-question fs-1"></i>
                                                            <span class="d-block"> Question </span>
                                                        </label>
                                                    </div>
                                                    <!-- Post type item -->
                                                    <div class="flex-fill">
                                                        <input type="radio" class="btn-check" value="Poll" name="post_type" id="option3" <?php if ($post['post_type'] == 'Poll') echo 'checked'; ?>>
                                                        <label class="btn btn-outline-light w-100" for="option3">
                                                            <i class="bi bi-chat-right-dots fs-1"></i>
                                                            <span class="d-block"> Poll </span>
                                                        </label>
                                                    </div>
                                                    <!-- Post type item -->
                                                    <div class="flex-fill">
                                                        <input type="radio" class="btn-check" value="Images" name="post_type" id="option4" <?php if ($post['post_type'] == 'Images') echo 'checked'; ?>>
                                                        <label class="btn btn-outline-light w-100" for="option4">
                                                            <i class="bi bi-ui-checks-grid fs-1"></i>
                                                            <span class="d-block"> Images </span>
                                                        </label>
                                                    </div>
                                                    <!-- Post type item -->
                                                    <div class="flex-fill">
                                                        <input type="radio" class="btn-check" value="Video" name="post_type" id="option5" <?php if ($post['post_type'] == 'Video') echo 'checked'; ?>>
                                                        <label class="btn btn-outline-light w-100" for="option5">
                                                            <i class="bi bi-camera-reels fs-1"></i>
                                                            <span class="d-block"> Video </span>
                                                        </label>
                                                    </div>
                                                    <!-- Post type item -->
                                                    <div class="flex-fill">
                                                        <input type="radio" class="btn-check" value="Other" name="post_type" id="option6" <?php if ($post['post_type'] == 'Other') echo 'checked'; ?>>
                                                        <label class="btn btn-outline-light w-100" for="option6">
                                                            <i class="bi bi-chat-square fs-1"></i>
                                                            <span class="d-block"> Other </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Post type END -->

                                        <!-- Short description -->
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Short description</label>
                                                <textarea class="form-control" name="short_description" rows="3"><?php echo htmlspecialchars($post['short_description']); ?></textarea>
                                            </div>
                                        </div>

                                        <!-- Post body -->
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Post body</label>
                                                <textarea required rows="25" id="con-name" name="post_body" class="form-control"><?php echo htmlspecialchars($post['post_body']); ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-4">
                                            <div class="mb-3">
                                                <!-- Image upload fields -->
                                                <div class="col-12">
                                                    <!-- Cover Image -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Cover Image</label>
                                                        <br>

                                                        <img style="max-width: 300px; height: auto;" src="<?php echo htmlspecialchars(!empty($images['cover_image']) ? 'http://localhost/Lucas/painel/add-postage/uploads/' . $images['cover_image'] : 'http://localhost/Lucas/assets/images/default.jpg'); ?>" alt="Cover Image" class="img-thumbnail">


                                                        <input class="form-control" type="file" name="cover_image" accept="image/*">
                                                        <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG, PNG.</p>
                                                    </div>
                                                    <!-- Image in the middle -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Image in the Middle</label>
                                                        <br>

                                                        <img style="max-width: 300px; height: auto;" src="<?php echo htmlspecialchars(!empty($images['middle_image']) ? 'http://localhost/Lucas/painel/add-postage/uploads/' . $images['middle_image'] : 'http://localhost/Lucas/assets/images/default.jpg'); ?>" alt="middle_image" class="img-thumbnail">

                                                        <input class="form-control" type="file" name="middle_image" accept="image/*">
                                                        <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG, PNG.</p>
                                                    </div>
                                                    <!-- Body Images -->
                                                    <div class="mb-3">

                                                        <label class="form-label">Body Images (3 images)</label>
                                                        <br>

                                                        <!-- Input e exibição para body_image1 -->
                                                        <input class="form-control mb-2" type="file" name="body_image1" accept="image/*">
                                                        <img style="max-width: 300px; height: auto;" src="<?php echo htmlspecialchars(!empty($images['body_image1']) ? 'http://localhost/Lucas/painel/add-postage/uploads/' . $images['body_image1'] : 'http://localhost/Lucas/assets/images/default.jpg'); ?>" alt="Body Image 1" class="img-thumbnail">

                                                        <!-- Input e exibição para body_image2 -->
                                                        <input class="form-control mb-2" type="file" name="body_image2" accept="image/*">
                                                        <img style="max-width: 300px; height: auto;" src="<?php echo htmlspecialchars(!empty($images['body_image2']) ? 'http://localhost/Lucas/painel/add-postage/uploads/' . $images['body_image2'] : 'http://localhost/Lucas/assets/images/default.jpg'); ?>" alt="Body Image 2" class="img-thumbnail">

                                                        <!-- Input e exibição para body_image3 -->
                                                        <input class="form-control" type="file" name="body_image3" accept="image/*">
                                                        <img style="max-width: 300px; height: auto;" src="<?php echo htmlspecialchars(!empty($images['body_image3']) ? 'http://localhost/Lucas/painel/add-postage/uploads/' . $images['body_image3'] : 'http://localhost/Lucas/assets/images/default.jpg'); ?>" alt="Body Image 3" class="img-thumbnail">
                                                        <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG, PNG. Max 3 images allowed.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-7">
                                            <!-- Tags -->
                                            <div class="mb-3">
                                                <label class="form-label">Tags</label>
                                                <textarea class="form-control" name="tags" rows="1"><?php echo htmlspecialchars($post['tags']); ?></textarea>
                                                <small>Maximum of 14 keywords. Keywords should all be in lowercase and separated by commas. e.g. javascript, react, marketing.</small>
                                            </div>
                                        </div>

                                        <div class="col-lg-5">
                                            <!-- Category -->
                                            <?php


                                            // Obtém o ID do post


                                            // Obtém os dados do post



                                            // Obtém todas as categorias
                                            $selectCategoriesQuery = "SELECT * FROM categories";
                                            $categoriesResult = $conn->query($selectCategoriesQuery);
                                            ?>

                                            <div class="col-lg-5">
                                                <!-- Category -->
                                                <div class="mb-3">
                                                    <label class="form-label">Category</label>
                                                    <select name="category_id" class="form-select" aria-label="Default select example">
                                                        <?php while ($category = $categoriesResult->fetch_assoc()): ?>
                                                            <option value="<?php echo htmlspecialchars($category['id']); ?>" <?php if ($post['category_id'] == $category['id']) echo 'selected'; ?>>
                                                                <?php echo htmlspecialchars($category['icon']); ?> <?php echo htmlspecialchars($category['name']); ?>
                                                            </option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- Checkbox -->
                                        <div class="col-12">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" name="featured" type="checkbox" value="1" id="postCheck" <?php if ($post['featured']) echo 'checked'; ?>>
                                                <label class="form-check-label" for="postCheck">
                                                    Make this post featured?
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Buttons -->
                                        <div class="col-md-12 text-start">
                                            <button class="btn btn-primary" type="submit" name="update">Save changes</button>
                                            <button class="btn btn-danger" type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this post?');">Delete post</button>
                                        </div>
                                    </div>
                                </form>


                                <!-- Form END -->
                            </div>
                        </div>
                        <!-- Chart END -->
                    </div>
                </div>
            </div>
        </section>
        <!-- =======================
Post edit END -->

    </main>
    <!-- **************** MAIN CONTENT END **************** -->

    <!-- =======================
Footer START -->
    <footer class="mb-3">
        <div class="container">
            <div class="card card-body bg-light">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-6">
                        <!-- Copyright -->
                        <div class="text-center text-lg-start">©2023 <a href="https://www.News.com/" class="text-reset btn-link" target="_blank">News</a>. All rights reserved
                        </div>
                    </div>
                    <div class="col-lg-6 d-sm-flex align-items-center justify-content-center justify-content-lg-end">
                        <!-- Language switcher -->
                        <div class="dropup me-0 me-sm-3 mt-3 mt-md-0 text-center text-sm-end">
                            <a class="dropdown-toggle text-body" href="#" role="button" id="languageSwitcher" data-bs-toggle="dropdown" aria-expanded="false">
                                English Edition
                            </a>
                            <ul class="dropdown-menu min-w-auto" aria-labelledby="languageSwitcher">
                                <li><a class="dropdown-item" href="#">English</a></li>
                                <li><a class="dropdown-item" href="#">German </a></li>
                                <li><a class="dropdown-item" href="#">French</a></li>
                            </ul>
                        </div>
                        <!-- Links -->
                        <ul class="nav text-center text-sm-end justify-content-center justify-content-center mt-3 mt-md-0">
                            <li class="nav-item"><a class="nav-link" href="#">Terms</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Privacy</a></li>
                            <li class="nav-item"><a class="nav-link pe-0" href="#">Cookies</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- =======================
Footer END -->

    <!-- Back to top -->
    <div class="back-top"><i class="bi bi-arrow-up-short"></i></div>

    <!-- =======================
JS libraries, plugins and custom scripts -->

    <!-- Bootstrap JS -->
    <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Vendors -->
    <script src="../../assets/vendor/apexcharts/js/apexcharts.min.js"></script>
    <script src="../../assets/vendor/quill/js/quill.min.js"></script>

    <!-- Template Functions -->
    <script src="../../assets/js/functions.js"></script>

</body>

<!-- Mirrored from News.News.com/dashboard-post-edit.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 22:30:58 GMT -->

</html>