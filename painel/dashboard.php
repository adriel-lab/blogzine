<?php
session_start();

// Verifica se o usuário está logado e é um admin
if (!isset($_SESSION['user']) || $_SESSION['access_level'] !== 'admin') {
	header("Location: http://localhost/Lucas/painel/"); // Redireciona para login se não estiver autenticado ou não for admin
	exit();
}
?>
<?php
// Iniciar a sessão e incluir a conexão com o banco de dados

include 'C:/xampp/htdocs/Lucas/bd/conexao.php';

// Consulta SQL para contar o número de posts
$sql = "SELECT COUNT(*) AS total_posts FROM posts";
$result = $conn->query($sql);

// Verificar se a consulta foi bem-sucedida
if ($result) {
	$row = $result->fetch_assoc();
	$total_posts = $row['total_posts'];
	//echo "Número total de posts: " . $total_posts;
} else {
	//echo "Erro ao executar a consulta: " . $conn->error;
}



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
	<link rel="shortcut icon" href="../assets/images/favicon.ico">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.gstatic.com/">
	<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700&amp;family=Rubik:wght@400;500;700&amp;display=swap" rel="stylesheet">
	<!-- DataTables CSS -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="../assets/vendor/font-awesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/vendor/bootstrap-icons/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="../assets/vendor/apexcharts/css/apexcharts.css">
	<link rel="stylesheet" type="text/css" href="../assets/vendor/overlay-scrollbar/css/OverlayScrollbars.min.css">

	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">

</head>

<body>
	<!-- =======================

<?php
$logo =  "http://localhost/Lucas/assets/images/logo.png"; //trocar se for hospedar
$logo_light = "http://localhost/Lucas/assets/images/logo-light.png";  //trocar se for hospedar
?>
Header START -->
	<?php include 'C:/xampp/htdocs/Lucas/pages/painel_header.php';  ?>
	<!-- =======================
Header END -->

	<!-- **************** MAIN CONTENT START **************** -->
	<main>

		<!-- =======================
Main contain START -->
		<section class="py-4">
			<div class="container">
				<div class="row g-4">

					<div class="col-12">
						<!-- Counter START -->
						<div class="row g-4">

							<!-- Counter item -->
							<div class="col-sm-6 col-lg-3">
								<div class="card card-body border p-3">
									<div class="d-flex align-items-center">
										<!-- Icon -->
										<div class="icon-xl fs-1 bg-success bg-opacity-10 rounded-3 text-success">
											<i class="bi bi-people-fill"></i>
										</div>
										<!-- Content -->
										<div class="ms-3">
											<h3>134K</h3>
											<h6 class="mb-0">Pageviews</h6>
										</div>
									</div>
								</div>
							</div>

							<!-- Counter item -->
							<div class="col-sm-6 col-lg-3">
								<div class="card card-body border p-3">
									<div class="d-flex align-items-center">
										<!-- Icon -->
										<div class="icon-xl fs-1 bg-primary bg-opacity-10 rounded-3 text-primary">
											<i class="bi bi-file-earmark-text-fill"></i>
										</div>
										<!-- Content -->
										<div class="ms-3">
											<h3><?php echo $total_posts; ?></h3>
											<h6 class="mb-0">Posts</h6>
										</div>
									</div>
								</div>
							</div>

							<!-- Counter item -->
							<div class="col-sm-6 col-lg-3">
								<div class="card card-body border p-3">
									<div class="d-flex align-items-center">
										<!-- Icon -->
										<div class="icon-xl fs-1 bg-danger bg-opacity-10 rounded-3 text-danger">
											<i class="bi bi-suit-heart-fill"></i>
										</div>
										<!-- Content -->
										<div class="ms-3">
											<h3>2150</h3>
											<h6 class="mb-0">Likes</h6>
										</div>
									</div>
								</div>
							</div>

							<!-- Counter item -->
							<div class="col-sm-6 col-lg-3">
								<div class="card card-body border p-3">
									<div class="d-flex align-items-center">
										<!-- Icon -->
										<div class="icon-xl fs-1 bg-info bg-opacity-10 rounded-3 text-info">
											<i class="bi bi-bar-chart-line-fill"></i>
										</div>
										<!-- Content -->
										<div class="ms-3">
											<h3>84K</h3>
											<h6 class="mb-0">Visitors</h6>
										</div>
									</div>
								</div>
							</div>

						</div>
						<!-- Counter END -->
					</div>

					<div class="col-xl-8">
						<!-- Chart START -->
						<div class="card border h-100">

							<!-- Card header -->
							<div class="card-header p-3 border-bottom">
								<h5 class="card-header-title mb-0">Traffic stats</h5>
							</div>
							<!-- Card body -->
							<div class="card-body">
								<!-- Apex chart -->
								<div id="apexChartTrafficStats" class="mt-2"></div>
							</div>
						</div>
						<!-- Chart END -->
					</div>

					<?php
					// Inclui a conexão ao banco de dados


					// Consulta para obter os 5 posts mais recentes
					$latestPostsQuery = "SELECT * FROM posts ORDER BY created_at DESC LIMIT 4";
					$latestPostsResult = $conn->query($latestPostsQuery);

					?>

					<div class="col-md-6 col-xxl-4">
						<!-- Latest blog START -->
						<div class="card border h-100">
							<!-- Card header -->
							<div class="card-header border-bottom p-3">
								<h5 class="card-header-title mb-0">Latest post</h5>
							</div>

							<!-- Card body START -->
							<div class="card-body p-3">
								<div class="row">
									<?php while ($post = $latestPostsResult->fetch_assoc()): ?>
										<?php
										// Buscar a imagem de capa do post
										$coverImageQuery = "SELECT image_path FROM images WHERE post_id = ? AND image_type = 'cover_image' LIMIT 1";
										$stmt = $conn->prepare($coverImageQuery);
										$stmt->bind_param("i", $post['id']);
										$stmt->execute();
										$coverImageResult = $stmt->get_result();
										$coverImage = $coverImageResult->fetch_assoc();
										?>
										<!-- Blog item -->
										<div class="col-12">
											<div class="d-flex align-items-center position-relative">
												<img class="w-60 rounded" src="<?php echo htmlspecialchars(!empty($coverImage['image_path']) ? 'http://localhost/Lucas/painel/add-postage/uploads/' . $coverImage['image_path'] : 'http://localhost/Lucas/assets/images/default.jpg'); ?>" alt="product">


												<div class="ms-3">
													<a href="http://localhost/Lucas/post-single-2.php?id=<?php echo htmlspecialchars($post['id']); ?>" class="h6 stretched-link"><?php echo htmlspecialchars($post['name']); ?></a>
													<p class="small mb-0"><?php echo date('M d, Y', strtotime($post['created_at'])); ?></p>
												</div>
											</div>
										</div>
										<!-- Divider -->
										<hr class="my-3">
									<?php endwhile; ?>
								</div>
							</div>
							<!-- Card body END -->


						</div>
						<!-- Latest blog END -->
					</div>



					<div class="col-md-6 col-xxl-4">
						<!-- Recent comment START -->
						<div class="card border h-100">
							<!-- Card header -->
							<div class="card-header border-bottom p-3">
								<h5 class="card-header-title mb-0">Recent comments</h5>
							</div>

							<!-- Card body START -->
							<div class="card-body p-3">

								<div class="row">
									<!-- Comment item -->
									<div class="col-12">
										<div class="d-flex align-items-center position-relative">
											<!-- Avatar -->
											<div class="avatar avatar-lg flex-shrink-0">
												<img class="avatar-img rounded-2" src="../assets/images/avatar/06.jpg" alt="avatar">
											</div>
											<!-- Info -->
											<div class="ms-3">
												<p class="mb-1"> <a class="h6 fw-normal stretched-link" href="#"> Supposing so be resolving breakfast am or perfectly.. </a></p>
												<div class="d-flex justify-content-between">
													<p class="small mb-0">by Joan</p>
												</div>
											</div>
										</div>
									</div>

									<!-- Divider -->
									<hr class="my-3">

									<!-- Comment item -->
									<div class="col-12">
										<div class="d-flex align-items-center position-relative">
											<!-- Avatar -->
											<div class="avatar avatar-lg flex-shrink-0">
												<img class="avatar-img rounded-2" src="../assets/images/avatar/08.jpg" alt="avatar">
											</div>
											<!-- Info -->
											<div class="ms-3">
												<p class="mb-1"> <a class="h6 fw-normal stretched-link" href="#"> We focus a great deal on the understanding of behavioral.. </a></p>
												<div class="d-flex justify-content-between">
													<p class="small mb-0">by Allen Smith</p>
												</div>
											</div>
										</div>
									</div>

									<!-- Divider -->
									<hr class="my-3">

									<!-- Comment item -->
									<div class="col-12">
										<div class="d-flex align-items-center position-relative">
											<!-- Avatar -->
											<div class="avatar avatar-lg flex-shrink-0">
												<img class="avatar-img rounded-2" src="../assets/images/avatar/04.jpg" alt="avatar">
											</div>
											<!-- Info -->
											<div class="ms-3">
												<p class="mb-1"> <a class="h6 fw-normal stretched-link" href="#"> Supposing so be resolving breakfast am or perfectly.. </a></p>
												<div class="d-flex justify-content-between">
													<p class="small mb-0">by Louis Ferguson</p>
												</div>
											</div>
										</div>
									</div>

									<!-- Divider -->
									<hr class="my-3">

									<!-- Comment item -->
									<div class="col-12">
										<div class="d-flex align-items-center position-relative">
											<!-- Avatar -->
											<div class="avatar avatar-lg flex-shrink-0">
												<img class="avatar-img rounded-2" src="../assets/images/avatar/05.jpg" alt="avatar">
											</div>
											<!-- Info -->
											<div class="ms-3">
												<p class="mb-1"> <a class="h6 fw-normal stretched-link" href="#"> Supposing so be resolving breakfast am or perfectly.. </a></p>
												<div class="d-flex justify-content-between">
													<p class="small mb-0">by Joan Wallace</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Card body END -->
						</div>
						<!-- Recent comment END -->
					</div>

					<?php



					// Consulta para recuperar categorias
					$sql = "SELECT * FROM categories ORDER BY RAND() LIMIT 10";
					$result = $conn->query($sql);

					// Iniciar buffer de saída
					ob_start();
					?>

					<div class="col-md-6 col-xxl-4">
						<!-- Notice board START -->
						<div class="card border h-100">
							<!-- Card header -->
							<div class="card-header border-bottom d-flex justify-content-between align-items-center p-3">
								<h5 class="card-header-title mb-0">Categories</h5>
								<!-- Dropdown button -->
							</div>

							<!-- Card body START -->
							<div class="card-body p-3">
								<div class="custom-scrollbar h-350">
									<div class="row">
										<?php
										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
												echo '<div class="col-12">';
												echo '    <div class="d-flex justify-content-between position-relative">';
												echo '        <div class="d-sm-flex">';
												echo '            <div class="icon-lg bg-warning bg-opacity-15 text-warning rounded-2 flex-shrink-0">';
												echo  htmlspecialchars($row['icon']) . '</i>';
												echo '            </div>';
												echo '            <!-- Info -->';
												echo '            <div class="ms-0 ms-sm-3 mt-2 mt-sm-0">';
												echo '                <h6 class="mb-0"><a href="#" class="stretched-link">' . htmlspecialchars($row['name']) . '</a></h6>';
												echo '                <p class="mb-0">' . htmlspecialchars($row['description']) . '</p>';
												echo '                <span class="small">' . htmlspecialchars($row['created_at']) . '</span>';
												echo '            </div>';
												echo '        </div>';
												echo '    </div>';
												echo '</div>';
												echo '<!-- Divider -->';
												echo '<hr class="my-3">';
											}
										} else {
											echo '<div class="col-12">No categories found.</div>';
										}
										?>
									</div><!-- Row END -->
								</div>
							</div>
							<!-- Card body END -->

							<!-- Card footer -->
							<div class="card-footer border-top text-center p-3">
								<a href="categories">View all Categories</a>
							</div>

						</div>
					</div>

					<?php
					// Capturar o conteúdo gerado
					$content = ob_get_clean();

					// Fechar a conexão
					$conn->close();

					// Exibir o conteúdo
					echo $content;
					?>


					<div class="col-md-6 col-xxl-4">
						<div class="card border h-100">

							<!-- Card header -->
							<div class="card-header border-bottom d-flex justify-content-between align-items-center p-3">
								<h5 class="card-header-title mb-0">Traffic sources</h5>
								<a href="#" class="btn btn-sm btn-link p-0 mb-0 text-reset">View all</a>
							</div>

							<!-- Card body START -->
							<div class="card-body p-4">
								<!-- Chart -->
								<div class=" mx-auto">
									<div id="apexChartTrafficSources"></div>
								</div>
								<!-- Content -->
								<ul class="list-inline text-center mt-3">
									<li class="list-inline-item pe-2"><i class="text-primary fas fa-circle pe-1"></i> Search </li>
									<li class="list-inline-item pe-2"><i class="text-success fas fa-circle pe-1"></i> Direct </li>
									<li class="list-inline-item pe-2"><i class="text-danger fas fa-circle pe-1"></i> Social </li>
									<li class="list-inline-item pe-2"><i class="text-warning fas fa-circle pe-1"></i> Display ads </li>
								</ul>
							</div>
						</div>
					</div>
					<style>
						/* Oculta o campo de busca padrão do DataTables */
						.dataTables_filter {
							display: none;
						}
					</style>
					<div class="col-12">
						<!-- Blog list table START -->
						<div class="card border bg-transparent rounded-3">
							<!-- Card header START -->
							<div class="card-header bg-transparent border-bottom p-3">
								<div class="d-sm-flex justify-content-between align-items-center">
									<h5 class="mb-2 mb-sm-0">Blog list <span class="badge bg-primary bg-opacity-10 text-primary"><?php echo $total_posts; ?></span></h5>
									<a href="add-postage" class="btn btn-sm btn-primary mb-0">Add New</a>
								</div>
							</div>
							<!-- Card header END -->

							<!-- Card body START -->
							<div class="card-body">

								<!-- Search and select START -->
								<div class="row g-3 align-items-center justify-content-between mb-3">
									<!-- Search -->
									<div class="col-md-8">
										<form class="rounded position-relative">
											<input id="customSearch" class="form-control pe-5 bg-transparent" type="search" placeholder="Search" aria-label="Search">
											<button id="searchButton" class="btn bg-transparent border-0 px-2 py-0 position-absolute top-50 end-0 translate-middle-y" type="button">
												<i class="fas fa-search fs-6"></i>
											</button>


										</form>
									</div>

									<!-- Select option -->
									<div class="col-md-3">
										<!-- Short by filter -->
										<form>
											<select class="form-select z-index-9 bg-transparent" aria-label=".form-select-sm">
												<option value="">Sort by</option>
												<option>Free</option>
												<option>Newest</option>
												<option>Oldest</option>
											</select>
										</form>
									</div>

								</div>
								<!-- Search and select END -->

								<!-- Blog list table START -->
								<div class="table-responsive border-0">
									<?php

									include 'C:/xampp/htdocs/Lucas/bd/conexao.php';

									// Consulta SQL para obter posts
									$sql = "SELECT id, name, post_type, short_description, created_at, category_id, featured
        FROM posts
        ORDER BY created_at DESC";
									$result = $conn->query($sql);

									?>

<table id="blogTable" class="table align-middle p-4 mb-0 table-hover table-shrink">
    <!-- Table head -->
    <thead class="table-dark">
        <tr>
            <th scope="col" class="border-0 rounded-start">ID</th>
            <th scope="col" class="border-0">Post Name</th>
            <th scope="col" class="border-0">Type</th>
            <th scope="col" class="border-0">Published Date</th>
            <th scope="col" class="border-0">Categories</th>
            <th scope="col" class="border-0">Status</th>
            <th scope="col" class="border-0 rounded-end">Action</th>
        </tr>
    </thead>

    <!-- Table body START -->
    <tbody class="border-top-0">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Definindo o status como "Featured" ou "Not Featured"
                $status_class = $row['featured'] ? 'bg-success bg-opacity-10 text-success' : 'bg-secondary bg-opacity-10 text-secondary';
                $status_text = $row['featured'] ? 'Featured' : 'Not Featured';

                // Consulta para obter o ícone da categoria
                $category_id = !empty($row['category_id']) ? intval($row['category_id']) : 0;
                $category_query = "SELECT * FROM categories WHERE id = ?";
                $stmt_category = $conn->prepare($category_query);
                $stmt_category->bind_param("i", $category_id);
                $stmt_category->execute();
                $category_result = $stmt_category->get_result();
                $category = $category_result->fetch_assoc();

                // Exibir o ícone da categoria
                $category_display = !empty($category['icon']) ? htmlspecialchars($category['icon']) : 'N/A';

                echo '<tr>
                    <td>
                        <h6 class="course-title mt-2 mt-md-0 mb-0"><a href="#">' . htmlspecialchars($row['id']) . '</a></h6>
                    </td>
                    <td>
                        <h6 class="course-title mt-2 mt-md-0 mb-0"><a href="http://localhost/Lucas/post-single-2.php?id=' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['name']) . '</a></h6>
                    </td>
                    <td>' . htmlspecialchars($row['post_type']) . '</td>
                    <td>' . date('M d, Y', strtotime($row['created_at'])) . '</td>
                    <td><center>' . $category_display .' '.$category['name'] . '</center></td>
                    <td>
                        <span class="badge ' . $status_class . ' mb-2">' . $status_text . '</span>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="add-postage/edit.php?id=' . $row['id'] . '" class="btn btn-light btn-round mb-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="bi bi-trash"></i></a>
                            <a href="add-postage/edit.php?id=' . $row['id'] . '" class="btn btn-light btn-round mb-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="bi bi-pencil-square"></i></a>
                        </div>
                    </td>
                </tr>';
            }
        } else {
            echo '<tr><td colspan="7">No posts found</td></tr>';
        }
        ?>
    </tbody>
    <!-- Table body END -->
</table>


									<?php
									$conn->close();
									?>

								</div>
								<!-- Blog list table END -->

								<!-- Pagination START -->
								<div class="d-sm-flex justify-content-sm-between align-items-sm-center mt-4 mt-sm-3">
									<!-- Content -->


								</div>

								<!-- Pagination END -->
								<!-- jQuery (necessário para o DataTables) -->
								<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>





								<!-- DataTables JS -->
								<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
								<script>
									$(document).ready(function() {
										var table = $('#blogTable').DataTable({
											"dom": 'rtip',
											"pagingType": "simple_numbers",
											"language": {
												"paginate": {
													"previous": "Prev",
													"next": "Next"
												},
												"info": "Showing _START_ to _END_ of _TOTAL_ entries"
											}
										});

										// Conecta o campo de busca customizado com a busca do DataTables
										$('#customSearch').on('keyup', function() {
											table.search(this.value).draw();
										});



										// Função de ordenação customizada
										$('.form-select').on('change', function() {
											var selectedValue = $(this).val();

											switch (selectedValue) {
												case 'Newest':
													table.order([3, 'desc']).draw(); // Ordena pela data de publicação (descendente)
													break;
												case 'Oldest':
													table.order([3, 'asc']).draw(); // Ordena pela data de publicação (ascendente)
													break;
												case 'Free':
													table.order([3, 'asc']).draw(); // Exemplo de ordenação por categoria (ascendente)
													break;
												default:
													table.order([0, 'asc']).draw(); // Ordem padrão por nome do blog
											}
										});
									});
								</script>
								<script>
									$(document).ready(function() {
										$('#searchButton').on('click', function(event) {
											event.preventDefault(); // Previne qualquer ação padrão
										});
									});
								</script>



							</div>
							<!-- Blog list table END -->
						</div>
					</div>
				</div>
		</section>
		<!-- =======================
Main contain END -->

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
	<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

	<!-- Vendors -->
	<script src="../assets/vendor/apexcharts/js/apexcharts.min.js"></script>
	<script src="../assets/vendor/overlay-scrollbar/js/OverlayScrollbars.min.js"></script>

	<!-- Template Functions -->
	<script src="../assets/js/functions.js"></script>

</body>



</html>