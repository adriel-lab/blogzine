<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">


<head>
    <title>Blogzine - Blog and Magazine Bootstrap 5 Theme</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Webestica.com">
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
    <link rel="stylesheet" type="text/css" href="../../assets/vendor/overlay-scrollbar/css/OverlayScrollbars.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">

</head>

<body>
    <!-- =======================
Header START -->
    <?php include 'C:/xampp/htdocs/Lucas/pages/painel_header.php';  ?>
    <!-- =======================
Header END -->

    <!-- **************** MAIN CONTENT START **************** -->
    <main>
        <?php

        include 'C:/xampp/htdocs/Lucas/bd/conexao.php';
        // Consulta para contar o número total de categorias
        $sql = "SELECT COUNT(*) AS total_categories FROM categories";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Obter o número total de categorias
            $row = $result->fetch_assoc();
            $total_categories = $row['total_categories'];

            // Exibir o número total de categorias
           // echo "<h2>Total de Categorias: " . htmlspecialchars($total_categories) . "</h2>";
        } else {
            //echo "Não foram encontradas categorias.";
        }


        ?>

        <!-- =======================
Main contain START -->
        <section class="py-4">
            <div class="container">
                <div class="row pb-4">
                    <div class="col-12">
                        <!-- Title -->
                        <div class="d-sm-flex justify-content-sm-between align-items-center">
                            <h1 class="mb-2 mb-sm-0 h2">Categories <span class="badge bg-primary bg-opacity-10 text-primary"><?php echo $total_categories; ?></span></h1>
                            <a href="#" class="btn btn-sm btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                <i class="fas fa-plus me-2"></i>Add new category
                            </a>
                        </div>
                    </div>
                </div>

                <?php


                if (isset($_SESSION['message'])) {
                    echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
                    unset($_SESSION['message']);
                }
                ?>


                <?php


                // Consulta para obter categorias
                $sql = "SELECT * FROM categories";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Início da estrutura HTML
                    echo '<div class="row g-4">';

                    // Loop para gerar cards de categorias
                    while ($row = $result->fetch_assoc()) {
                        $id = $row["id"];
                        $name = $row["name"];
                        $description = $row["description"];
                        $icon = $row["icon"];

                        // Renderizar o card para cada categoria
                        echo '<div class="col-md-6 col-xl-4">';
                        echo '<div class="card border h-100">';
                        echo '<div class="card-header border-bottom p-3">';
                        echo '<div class="d-flex align-items-center">';
                        echo '<div class="icon-lg shadow bg-body rounded-circle">' . htmlspecialchars($icon) . '</div>';
                        echo '<h3 class="mb-0 ms-3">' . htmlspecialchars($name) . '</h3>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="card-body p-3">';
                        echo '<p>' . htmlspecialchars($description) . '</p>';
                        echo '<div class="d-flex justify-content-between">';
                        echo '<div>';
                        // Aqui você pode adicionar o código para mostrar o número de posts, se necessário
                        echo '<h5 class="mb-0">ID: ' . htmlspecialchars($id) . '</h5>';
                        echo '</div>';
                        echo '<ul class="avatar-group mb-0">';
                        echo '<li class="avatar avatar-xs">';
                        echo '<div class="avatar-img rounded-circle bg-primary"><i class="fas fa-check text-white position-absolute top-50 start-50 translate-middle"></i></div>';
                        echo '</li>';
                        echo '</ul>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="card-footer border-top text-center p-3">';
                        echo '<a href="edit.php?id=' . $id . '" class="btn btn-primary-soft w-100 mb-0" >Edit</a>';
                        echo '<br>';
                        echo '<br>';
                        
                        echo '<a href="delete.php?id=' . $id . '" class="btn btn-danger-soft w-100 mb-0">Delete</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }

                    // Fim da estrutura HTML
                    echo '</div>';
                } else {
                    echo "Nenhuma categoria encontrada.";
                }


                ?>

            </div>
        </section>
        <!-- =======================
Main contain END -->

    </main>
    <!-- **************** MAIN CONTENT END **************** -->
    <!-- Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm" method="post" action="add.php">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="categoryDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="categoryDescription" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="categoryIcon" class="form-label">Icon</label>
                            <input type="text" class="form-control" id="categoryIcon" name="icon">
                            <p class="small mb-0 mt-2">Enter the icon emoji (e.g., '💎' for android, [windows + >], ios). Use emojis like 🚗, 🌟, 🛠️, etc.</p>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- =======================
Footer START -->

    <footer class="mb-3">
        <div class="container">
            <div class="card card-body bg-light">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-6">
                        <!-- Copyright -->
                        <div class="text-center text-lg-start">©2023 <a href="https://www.webestica.com/" class="text-reset btn-link" target="_blank">Webestica</a>. All rights reserved
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
    <script src="../../assets/vendor/overlay-scrollbar/js/OverlayScrollbars.min.js"></script>

    <!-- Template Functions -->
    <script src="../../assets/js/functions.js"></script>

</body>

<!-- Mirrored from blogzine.webestica.com/dashboard-post-categories.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 22:30:58 GMT -->

</html>