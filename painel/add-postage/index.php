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
                    <?php
                    if (isset($_SESSION['success'])) {
                        echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                        unset($_SESSION['success']);
                    }

                    if (isset($_SESSION['error'])) {
                        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                        unset($_SESSION['error']);
                    }
                    ?>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- Chart START -->
                        <div class="card border h-100">
                            <!-- Card body -->
                            <div class="card-body">
                                <!-- Form START -->
                                <form action="process_form.php" method="POST" enctype="multipart/form-data">
                                    <!-- Main form -->
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Post name -->
                                            <div class="mb-3">
                                                <label class="form-label">Post name</label>
                                                <input required id="con-name" name="name" type="text" class="form-control">
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
                                                        <input type="radio" class="btn-check" value="post" name="post_type" id="option">
                                                        <label class="btn btn-outline-light w-100" for="option">
                                                            <i class="bi bi-chat-left-text fs-1"></i>
                                                            <span class="d-block"> Post </span>
                                                        </label>
                                                    </div>
                                                    <!-- Post type item -->
                                                    <div class="flex-fill">
                                                        <input type="radio" class="btn-check" value="question" name="post_type" id="option2">
                                                        <label class="btn btn-outline-light w-100" for="option2">
                                                            <i class="bi bi-patch-question fs-1"></i>
                                                            <span class="d-block"> Question </span>
                                                        </label>
                                                    </div>
                                                    <!-- Post type item -->
                                                    <div class="flex-fill">
                                                        <input type="radio" class="btn-check" name="post_type" id="option3">
                                                        <label class="btn btn-outline-light w-100" for="option3">
                                                            <i class="bi bi-chat-right-dots fs-1"></i>
                                                            <span class="d-block"> Poll </span>
                                                        </label>
                                                    </div>
                                                    <!-- Post type item -->
                                                    <div class="flex-fill">
                                                        <input type="radio" class="btn-check" value="images" name="post_type" id="option4">
                                                        <label class="btn btn-outline-light w-100" for="option4">
                                                            <i class="bi bi-ui-checks-grid fs-1"></i>
                                                            <span class="d-block"> Images </span>
                                                        </label>
                                                    </div>
                                                    <!-- Post type item -->
                                                    <div class="flex-fill">
                                                        <input type="radio" class="btn-check" value="video" name="post_type" id="option5">
                                                        <label class="btn btn-outline-light w-100" for="option5">
                                                            <i class="bi bi-camera-reels fs-1"></i>
                                                            <span class="d-block"> Video </span>
                                                        </label>
                                                    </div>
                                                    <!-- Post type item -->
                                                    <div class="flex-fill">
                                                        <input type="radio" class="btn-check" value="other" name="post_type" id="option6">
                                                        <label class="btn btn-outline-light w-100" for="option6">
                                                            <i class="bi bi-chat-square fs-1"></i>
                                                            <span class="d-block"> Other </span>
                                                        </label>
                                                    </div>
                                                    <!-- Post type item -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Post type END -->

                                        <!-- Short description -->
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Short description </label>
                                                <textarea class="form-control" name="short_description" rows="3">For who thoroughly her boy estimating conviction. Removed demands expense account in outward tedious do.</textarea>
                                            </div>
                                        </div>

                                        <!-- Main toolbar -->
                                        <div class="col-md-12">
                                            <!-- Subject -->
                                            <div class="mb-3">
                                                <label class="form-label">Post body</label>
                                                <!-- Editor toolbar -->
                                                <textarea required rows="25" id="con-name" name="post_body" type="text" class="form-control"></textarea>
                                                <!-- Main toolbar -->

                                            </div>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <div class="mb-3">
                                                <!-- Image upload fields -->
                                                <div class="col-12">
                                                    <!-- Cover Image -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Cover Image</label>
                                                        <input class="form-control" type="file" name="cover_image" accept="image/*" required>
                                                        <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG, PNG.</p>
                                                    </div>
                                                    <!-- Image in the middle -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Image in the Middle</label>
                                                        <input class="form-control" type="file" name="middle_image" accept="image/*" required>
                                                        <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG, PNG.</p>
                                                    </div>
                                                    <!-- Body Images -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Body Images (3 images)</label>
                                                        <input class="form-control mb-2" type="file" name="body_image1" accept="image/*" required>
                                                        <input class="form-control mb-2" type="file" name="body_image2" accept="image/*" required>
                                                        <input class="form-control" type="file" name="body_image3" accept="image/*" required>
                                                        <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG, PNG. Max 3 images allowed.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <!-- Tags -->
                                            <div class="mb-3">
                                                <label class="form-label">Tags</label>
                                                <textarea class="form-control" name="tags" rows="1">business, sports, traveling</textarea>
                                                <small>Maximum of 14 keywords. Keywords should all be in lowercase and separated by commas. e.g. javascript, react, marketing.</small>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <!-- Message -->
                                            <div class="mb-3">
                                                <label class="form-label">Category</label>
                                                <select name="category_id" class="form-select" aria-label="Default select example">
                                                    <option selected>Travel</option>
                                                    <option value="1">Lifestyle</option>
                                                    <option value="2">Business</option>
                                                    <option value="3">Technology</option>
                                                    <option value="4">Marketing</option>
                                                    <option value="5">Photography</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Checkbox -->
                                        <div class="col-12">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" name="featured" type="checkbox" value="1" id="postCheck">
                                                <label class="form-check-label" for="postCheck">
                                                    Make this post featured?
                                                </label>
                                            </div>
                                        </div>
                                        <!-- Crate post button -->
                                        <div class="col-md-12 text-start">
                                            <button class="btn btn-primary" type="submit">Save change</button>
                                            <button class="btn btn-danger" type="submit">Delete post</button>
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