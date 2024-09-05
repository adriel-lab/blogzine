<?php
// Conexão com o banco de dados
include 'C:/xampp/htdocs/Lucas/bd/conexao.php';

// Obtendo o ID do post da URL
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Consulta para obter as informações do post
$query = "SELECT 
            p.id, 
            p.name AS post_name, 
            p.post_type, 
            p.short_description, 
            p.post_body, 
            p.tags, 
            p.featured, 
            p.created_at, 
            c.name AS category_name, 
            c.icon AS category_icon
          FROM posts p
          LEFT JOIN categories c ON p.category_id = c.id
          WHERE p.id = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

// Consulta para obter as imagens associadas ao post
$image_query = "SELECT image_path, image_type FROM images WHERE post_id = ?";
$image_stmt = $conn->prepare($image_query);
$image_stmt->bind_param("i", $post_id);
$image_stmt->execute();
$image_result = $image_stmt->get_result();

$images = [];
while ($row = $image_result->fetch_assoc()) {
	$images[$row['image_type']] = $row['image_path'];
}

// Variáveis para uso na página
$post_name = htmlspecialchars($post['post_name'] ?? 'N/A');
$post_type = htmlspecialchars($post['post_type'] ?? 'N/A');
$short_description = htmlspecialchars($post['short_description'] ?? 'N/A');
$post_body = htmlspecialchars($post['post_body'] ?? 'N/A');
$tags = htmlspecialchars($post['tags'] ?? 'N/A');
$category_name = htmlspecialchars($post['category_name'] ?? 'N/A');
$category_icon = htmlspecialchars($post['category_icon'] ?? '');
$featured = $post['featured'] ? 'Featured' : 'Not Featured';
$created_at = date('M d, Y', strtotime($post['created_at']));

// Variáveis para as imagens
$cover_image = !empty($images['cover_image']) ? 'http://localhost/Lucas/painel/add-postage/uploads/' . htmlspecialchars($images['cover_image']) : 'http://localhost/Lucas/assets/images/default.jpg';
$middle_image = !empty($images['middle_image']) ? 'http://localhost/Lucas/painel/add-postage/uploads/' . htmlspecialchars($images['middle_image']) : 'http://localhost/Lucas/assets/images/default.jpg';
$body_image1 = !empty($images['body_image1']) ? 'http://localhost/Lucas/painel/add-postage/uploads/' . htmlspecialchars($images['body_image1']) : 'http://localhost/Lucas/assets/images/default.jpg';
$body_image2 = !empty($images['body_image2']) ? 'http://localhost/Lucas/painel/add-postage/uploads/' . htmlspecialchars($images['body_image2']) : 'http://localhost/Lucas/assets/images/default.jpg';
$body_image3 = !empty($images['body_image3']) ? 'http://localhost/Lucas/painel/add-postage/uploads/' . htmlspecialchars($images['body_image3']) : 'http://localhost/Lucas/assets/images/default.jpg';
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
	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.gstatic.com/">
	<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700&amp;family=Rubik:wght@400;500;700&amp;display=swap" rel="stylesheet">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="assets/vendor/font-awesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap-icons/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/tiny-slider/tiny-slider.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/glightbox/css/glightbox.css">

	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>

<body>

	<!-- =======================
Header START -->
	<?php include 'pages/header.php';  ?>
	<!-- =======================
Header END -->

	<!-- **************** MAIN CONTENT START **************** -->
	<main>

		<!-- =======================
Inner intro START -->
		<section class="bg-dark-overlay-4" style="background-image:url(<?php echo $cover_image = !empty($images['cover_image']) ? 'http://localhost/Lucas/painel/add-postage/uploads/' . htmlspecialchars($images['cover_image']) : 'http://localhost/Lucas/assets/images/default_cover.jpg'; ?>); background-position: center left; background-size: cover;">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 py-md-5 my-lg-5">
						<a href="#" class="badge text-bg-warning mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Travel</a>
						<a href="#" class="badge bg-primary mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Photography</a>
						<h1 class="text-white"><?php echo $post_name = htmlspecialchars($post['post_name'] ?? 'N/A');  ?></h1>
						<p class="lead text-white"><?php echo $short_description = htmlspecialchars($post['short_description'] ?? 'N/A');  ?> </p>
						<!-- Info -->
						<ul class="nav nav-divider text-white-force align-items-center">
							<li class="nav-item">
								<div class="nav-link">
									<div class="d-flex align-items-center text-white position-relative">
										<div class="avatar avatar-sm">
											<img class="avatar-img rounded-circle" src="assets/images/avatar/12.jpg" alt="avatar">
										</div>
										<span class="ms-3">by <a href="#" class="stretched-link text-reset btn-link">News</a></span>
									</div>
								</div>
							</li>
							<li class="nav-item"><?php echo $created_at = date('M d, Y', strtotime($post['created_at'])); ?></li>
							<li class="nav-item">5 min read</li>
							<li class="nav-item"><i class="far fa-eye me-1"></i> 2344 Views</li>
							<li class="nav-item"><a href="#"><i class="fas fa-heart me-1 text-danger"></i></a> 266</li>
						</ul>
						<!-- Share post -->
						<div class="d-md-flex align-items-center mt-4">
							<h5 class="text-white me-3">Share on: </h5>
							<ul class="nav text-white-force">
								<li class="nav-item">
									<a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-facebook" href="#">
										<i class="fab fa-facebook-square align-middle"></i>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-twitter" href="#">
										<i class="fab fa-twitter-square align-middle"></i>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-linkedin" href="#">
										<i class="fab fa-linkedin align-middle"></i>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-pinterest" href="#">
										<i class="fab fa-pinterest align-middle"></i>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-primary" href="#">
										<i class="far fa-envelope align-middle"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- =======================
Inner intro END -->

		<!-- =======================
Main START -->
		<section>
			<div class="container position-relative" data-sticky-container>
				<div class="row">
					<!-- Main Content START -->
					<div class="col-lg-9 mb-5">

						<?php
						// Função para dividir o texto em parágrafos
						function format_paragraphs($text, $chars_per_paragraph, $middle_image)
						{
							$formatted_text = '';
							$length = strlen($text);
							$paragraph_count = 0;

							for ($i = 0; $i < $length; $i += $chars_per_paragraph) {
								// Extrai o parágrafo
								$paragraph = substr($text, $i, $chars_per_paragraph);

								// Adiciona a tag de parágrafo HTML
								$formatted_text .= "<p>{$paragraph}</p>";

								// Incrementa o contador de parágrafos
								$paragraph_count++;

								// Adiciona a imagem após o segundo parágrafo
								if ($paragraph_count == 2 && strpos($formatted_text, '<img') === false) {

									$formatted_text .= '<img src="' .  $middle_image . '" class="rounded float-start me-3 my-3" alt="...">';
								}
							}

							return $formatted_text;
						}

						// Número de caracteres por parágrafo
						$chars_per_paragraph = 320;

						// Recupera o texto do corpo do post e o formata
						echo $post_body = format_paragraphs($post['post_body'] ?? 'N/A', $chars_per_paragraph, $middle_image);
						?>

						<!-- Divider -->
						<div class="text-center h5 mb-4">. . .</div>

						<!-- Images -->
						<div class="row g-2">
							<div class="col-md-6">
								<a href="<?php echo $body_image1 ?>" data-glightbox data-gallery="image-popup">
									<img class="rounded" src="<?php echo $body_image1 ?>" alt="Image">
								</a>
							</div>
							<div class="col-md-6">
								<a href="<?php echo $body_image2 ?>" data-glightbox data-gallery="image-popup">
									<img class="rounded" src="<?php echo $body_image2 ?>" alt="Image">
								</a>
							</div>
							<div class="col-12">
								<!-- Image -->
								<figure class="figure">
									<a href="<?php echo $body_image3 ?>" data-glightbox data-gallery="image-popup">
										<img class="rounded" src="<?php echo $body_image3 ?>" alt="Image">
									</a>

								</figure>
							</div>
						</div>

						<!-- Divider -->
						<div class="text-center h5 mb-4">. . .</div>


						<!-- Next prev post START -->
						<?php
						include 'C:/xampp/htdocs/Lucas/bd/conexao.php';

						// Consulta para obter 2 postagens aleatórias
						$query = "SELECT p.id AS post_id, p.name AS post_name, i.image_path
          FROM posts p
          LEFT JOIN images i ON p.id = i.post_id AND i.image_type = 'cover_image'
          ORDER BY RAND()
          LIMIT 2";

						$result = $conn->query($query);

						$posts = [];
						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								$posts[] = $row;
							}
						}
						?>

						<div class="row g-0 my-3">
							<?php if (!empty($posts)): ?>
								<?php foreach ($posts as $index => $post): ?>
									<div class="col-sm-6 border p-3 p-md-4 position-relative <?php echo $index % 2 === 0 ? 'rounded-start' : 'rounded-end'; ?>">
										<div class="d-flex align-items-center">
											<!-- Icon -->
											<div class="bg-primary bg-opacity-10 h-auto align-items-center d-flex align-self-stretch">
												<i class="bi bi-chevron-compact-<?php echo $index % 2 === 0 ? 'left' : 'right'; ?> fs-3 text-primary px-1"></i>
											</div>
											<!-- Image -->
											<div class="col-3 d-none d-md-block">
												<img src="<?php echo !empty($post['image_path']) ? 'http://localhost/Lucas/painel/add-postage/uploads/' . htmlspecialchars($post['image_path']) : 'http://localhost/Lucas/assets/images/default.jpg'; ?>" alt="Image">
											</div>
											<!-- Title -->
											<div class="ms-3 <?php echo $index % 2 === 1 ? 'text-sm-end' : ''; ?>">
												<h5 class="m-0">
													<a href="post-single-2.php?id=<?php echo htmlspecialchars($post['post_id']); ?>" class="stretched-link btn-link text-reset"><?php echo htmlspecialchars($post['post_name']); ?></a>
												</h5>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>

						<!-- Next prev post START -->

						<!-- Author info START -->
						<div class="d-flex p-2 p-md-4 my-3 bg-primary bg-opacity-10 rounded">
							<!-- Avatar -->
							<a href="#">

							</a>
							<!-- Info -->
							<div>
								<div class="d-sm-flex align-items-center justify-content-between">
									<div>
										<h4 class="m-0"><a href="#" class="text-reset">NEWS</a></h4>
										<small>An editor at News</small>
									</div>

								</div>
								<p class="my-2"></p>
								<!-- Social icons -->
								<ul class="nav">
									<li class="nav-item">
										<a class="nav-link ps-0 pe-2 fs-5" href="#"><i class="fab fa-facebook-square"></i></a>
									</li>
									<li class="nav-item">
										<a class="nav-link px-2 fs-5" href="#"><i class="fab fa-twitter-square"></i></a>
									</li>
									<li class="nav-item">
										<a class="nav-link px-2 fs-5" href="#"><i class="fab fa-linkedin"></i></a>
									</li>
								</ul>
							</div>
						</div>
						<!-- Author info END -->

						<!-- Comments START -->

						<!-- Comments END -->
						<!-- Reply START -->

						<!-- Reply END -->

					</div>
					<!-- Main Content END -->
					<!-- Right sidebar START -->
					<?php


					// Consulta para obter 3 postagens aleatórias
					$query = "SELECT p.id AS post_id, p.name AS post_name, p.category_id, i.image_path
          FROM posts p
          LEFT JOIN images i ON p.id = i.post_id AND i.image_type = 'cover_image'
          ORDER BY RAND()
          LIMIT 3";

					$result = $conn->query($query);

					$posts = [];
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							$posts[] = $row;
						}
					}
					?>

					<div class="col-lg-3">
						<div data-sticky data-margin-top="80" data-sticky-for="991">
							<!-- Most read -->
							<div>
								<h5 class="mb-3">Related post</h5>
								<div class="tiny-slider dots-creative mt-3 mb-5">
									<div class="tiny-slider-inner"
										data-autoplay="false"
										data-hoverpause="true"
										data-gutter="0"
										data-arrow="false"
										data-dots="true"
										data-items="1">

										<?php foreach ($posts as $post): ?>
											<!-- Card item START -->
											<div class="card">
												<!-- Card img -->
												<div class="position-relative">
													<img class="card-img" src="<?php echo !empty($post['image_path']) ? 'http://localhost/Lucas/painel/add-postage/uploads/' . htmlspecialchars($post['image_path']) : 'http://localhost/Lucas/assets/images/default.jpg'; ?>" alt="Card image">
													<div class="card-img-overlay d-flex align-items-start flex-column p-3">
														<!-- Card overlay bottom -->
														<div class="w-100 mt-auto">
															<?php
															// Consulta para obter o ícone da categoria
															$category_id = !empty($post['category_id']) ? intval($post['category_id']) : 0;
															$category_query = "SELECT icon, name FROM categories WHERE id = ?";
															$stmt = $conn->prepare($category_query);
															$stmt->bind_param("i", $category_id);
															$stmt->execute();
															$result = $stmt->get_result();
															$category = $result->fetch_assoc();

															$category_icon = !empty($category['icon']) ? htmlspecialchars($category['icon']) : '';
															$category_name = !empty($category['name']) ? htmlspecialchars($category['name']) : 'N/A';
															?>
															<a href="#" class="badge text-bg-<?php echo $category_name == 'Marketing' ? 'info' : ($category_name == 'Sports' ? 'danger' : 'success'); ?> mb-2">
																<?php echo $category_icon; ?>
																<?php echo $category_name; ?>
															</a>
														</div>
													</div>
												</div>
												<div class="card-body p-0 pt-3">
													<h5 class="card-title">
														<a href="post-single-<?php echo htmlspecialchars($post['post_id']); ?>.html" class="btn-link text-reset fw-bold">
															<?php echo htmlspecialchars($post['post_name']); ?>
														</a>
													</h5>
												</div>
											</div>
											<!-- Card item END -->
										<?php endforeach; ?>

									</div>
								</div>
							</div>

							<!-- Advertisement -->
							<div class="mt-4">
								<a href="#" class="d-block card-img-flash">
									<img src="assets/images/adv.png" alt="">
								</a>
							</div>
						</div>
					</div>

					<!-- Right sidebar END -->
				</div>
			</div>
		</section>
		<!-- =======================
Main END -->

	</main>
	<!-- **************** MAIN CONTENT END **************** -->

	<!-- =======================
Footer START -->
	<?php include 'pages/footer.php';  ?>
	<!-- =======================
Footer END -->

	<!-- Back to top -->
	<div class="back-top"><i class="bi bi-arrow-up-short"></i></div>

	<!-- =======================
JS libraries, plugins and custom scripts -->

	<!-- Bootstrap JS -->
	<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

	<!-- Vendors -->
	<script src="assets/vendor/tiny-slider/tiny-slider.js"></script>
	<script src="assets/vendor/sticky-js/sticky.min.js"></script>
	<script src="assets/vendor/glightbox/js/glightbox.js"></script>

	<!-- Template Functions -->
	<script src="assets/js/functions.js"></script>

</body>


</html>