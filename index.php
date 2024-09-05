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

		const setTheme = function (theme) {
			if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
				document.documentElement.setAttribute('data-bs-theme', 'dark')
			} else {
				document.documentElement.setAttribute('data-bs-theme', theme)
			}
		}

		setTheme(getPreferredTheme())

		window.addEventListener('DOMContentLoaded', () => {
		    var el = document.querySelector('.theme-icon-active');
			if(el != 'undefined' && el != null) {
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
Main hero START -->
<?php include 'pages/hero.php';  ?>
<!-- =======================
Main hero END -->

<!-- =======================
Cards START -->
<?php include 'pages/cards.php';  ?>
<!-- =======================
Cards END -->

<!-- =======================
Adv START -->
<section class="py-3 my-2">
	<div class="container">
		<div class="row">
			<div class="col">
				<a href="#" class="d-block card-img-flash  rounded-3 overflow-hidden">
					<img src="assets/images/adv-3.png" alt="">
				</a>
			</div>
		</div>
	</div>
</section>
<!-- =======================
Adv END -->

<!-- =======================
Trending topics START -->
<section class="p-0">
	<div class="container">
		<div class="row">
			<div class="col">
				<!-- Slider -->
				<div class="tiny-slider arrow-hover arrow-dark arrow-round">
					<div class="tiny-slider-inner"
					data-autoplay="false"
					data-hoverpause="true"
					data-gutter="24"
					data-arrow="true"
					data-dots="false"
					data-items-xl="5" 
					data-items-lg="4" 
					data-items-md="3" 
					data-items-sm="2" 
					data-items-xs="2"
					>
						<!-- Category item -->
						<div>
							<div class="card card-overlay-bottom card-img-scale">
								<img class="card-img" src="assets/images/blog/1by1/thumb/01.jpg" alt="card image">
								<div class="card-img-overlay d-flex px-3 px-sm-5">
									<h5 class="mt-auto mx-auto">
										<a href="#" class="stretched-link btn-link fw-bold text-white">Travel</a>
									</h5>
								</div>
							</div>
						</div>
						<!-- Category item -->
						<div>
							<div class="card card-overlay-bottom card-img-scale">
								<img class="card-img" src="assets/images/blog/1by1/thumb/02.jpg" alt="card image">
								<div class="card-img-overlay d-flex px-3 px-sm-5">
									<h5 class="mt-auto mx-auto">
										<a href="#" class="stretched-link btn-link fw-bold text-white">Business</a>
									</h5>
								</div>
							</div>
						</div>
						<!-- Category item -->
						<div>
							<div class="card card-overlay-bottom card-img-scale">
								<img class="card-img" src="assets/images/blog/1by1/thumb/03.jpg" alt="card image">
								<div class="card-img-overlay d-flex px-3 px-sm-5">
									<h5 class="mt-auto mx-auto">
										<a href="#" class="stretched-link btn-link fw-bold text-white">Marketing</a>
									</h5>
								</div>
							</div>
						</div>
						<!-- Category item -->
						<div>
							<div class="card card-overlay-bottom card-img-scale">
								<img class="card-img" src="assets/images/blog/1by1/thumb/04.jpg" alt="card image">
								<div class="card-img-overlay d-flex px-3 px-sm-5">
									<h5 class="mt-auto mx-auto">
										<a href="#" class="stretched-link btn-link fw-bold text-white">Photography</a>
									</h5>
								</div>
							</div>
						</div>
						<!-- Category item -->
						<div>
							<div class="card card-overlay-bottom card-img-scale">
								<img class="card-img" src="assets/images/blog/1by1/thumb/05.jpg" alt="card image">
								<div class="card-img-overlay d-flex px-3 px-sm-5">
									<h5 class="mt-auto mx-auto">
									<a href="#" class="stretched-link btn-link fw-bold text-white">Sports</a>
									</h5>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Slider END -->
			</div>
		</div>
	</div>
</section>
<!-- =======================
Trending topics END -->

<!-- =======================
Newsletter START -->
<section class="pb-0 pt-3 mt-1">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="bg-dark p-3 p-sm-4 rounded-3 position-relative overflow-hidden">
					<div class="row">
						<div class="col-md-8 col-lg-6 mx-auto text-center py-5 position-relative">
							<!-- Title -->
							<h2 class="display-6 text-white">Never miss a story!</h2>
							<p class="text-white">Get the freshest headlines and updates sent uninterrupted to your inbox.</p>
							<!-- Form -->
							<form class="row row-cols-sm-auto g-2 align-items-center justify-content-center mt-3">
								<div class="col-12">
							    <input type="email" class="form-control" placeholder="Enter your email address">
							  </div>
							  <div class="col-12">
							    <button type="submit" class="btn btn-primary m-0">Subscribe</button>
							  </div>
							  <div class="form-text text-white opacity-6 mt-2">By subscribing you agree to our 
							  	<a href="#" class="text-decoration-underline text-reset">Privacy Policy</a>
							  </div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- =======================
Newsletter END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->

<!-- =======================
Footer START -->
<footer class="pb-5">
	<div class="container">
		<div class="row pt-5">
			<div class="col-lg-7 mx-auto text-center">
				<!-- Logo -->
				<img class="light-mode-item mx-auto" src="assets/images/logo.png" alt="logo">			
				<img class="dark-mode-item mx-auto" src="assets/images/logo-light.png" alt="logo">
				<p class="mt-3">The next-generation blog, news, and magazine theme for you to start sharing your stories today! This Bootstrap 5 based theme is ideal for all types of sites that deliver the news.</p>
				<!-- Links -->
        <ul class="nav text-center text-sm-end justify-content-center justify-content-center mt-3 mt-md-0">
          <li class="nav-item"><a class="nav-link" href="#">About</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Terms</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Privacy</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Career<span class="badge text-bg-danger ms-2">2 Job</span></a></li>
          <li class="nav-item"><a class="nav-link" href="#">Contact us</a></li>
          <li class="nav-item"><a class="nav-link pe-0" href="#">Cookies</a></li>
        </ul>
				<div class="mt-2">©2023 <a href="https://www.News.com/" class="text-reset btn-link" target="_blank">News</a>. All rights reserved </div>
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
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Vendors -->
<script src="assets/vendor/tiny-slider/tiny-slider.js"></script>
<script src="assets/vendor/jarallax/jarallax.min.js"></script>
<script src="assets/vendor/jarallax/jarallax-video.min.js"></script>

<!-- Template Functions -->
<script src="assets/js/functions.js"></script>

</body>


</html>