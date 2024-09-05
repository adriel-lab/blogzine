
<!DOCTYPE html>
<html lang="en">


<head>
	<title>NEWS - Blog and Magazine Bootstrap 5 Theme</title>
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
	<link rel="shortcut icon" href="../assets/images/favicon.ico">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.gstatic.com/">
	<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700&amp;family=Rubik:wght@400;500;700&amp;display=swap" rel="stylesheet">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="../assets/vendor/font-awesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/vendor/bootstrap-icons/bootstrap-icons.css">

	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">

</head>

<body>

<!-- =======================
Header START -->
<?php include '../pages/header.php';  ?>
<!-- =======================
Header END -->

<!-- **************** MAIN CONTENT START **************** -->
<main>

<!-- =======================
Inner intro START -->
<section>
	<div class="container">
		<div class="row">
      <div class="col-md-10 col-lg-8 col-xl-6 mx-auto">
        <div class="p-4 p-sm-5 bg-primary bg-opacity-10 rounded">
					<h2>Log in to your account</h2>
					<!-- Form START -->
					<form method="POST" action="login.php" class="mt-4">
						<!-- Email -->
						<div class="mb-3">
							<label class="form-label" for="exampleInputEmail1">Email address</label>
							<input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="E-mail">
						</div>
						<!-- Password -->
						<div class="mb-3">
							<label class="form-label" for="exampleInputPassword1">Password</label>
							<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="*********">
						</div>
						<!-- Checkbox -->
						<div class="mb-3 form-check">
							<input type="checkbox" class="form-check-input" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">keep me signed in</label>
						</div>
						<!-- Button -->
						<div class="row align-items-center">
							<div class="col-sm-4">
								<button type="submit" class="btn btn-success">Sign me in</button>
							</div>
							<div class="col-sm-8 text-sm-end">
								
							</div>
						</div>
					</form>
					<!-- Form END -->
					<hr>
					<!-- Social-media btn -->
					
        </div>
      </div>
    </div>
	</div>
</section>
<!-- =======================
Inner intro END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->

<!-- =======================
Footer START -->
<?php include '../pages/footer.php';  ?>
<!-- =======================
Footer END -->

<!-- Back to top -->
<div class="back-top"><i class="bi bi-arrow-up-short"></i></div>

<!-- =======================
JS libraries, plugins and custom scripts -->

<!-- Bootstrap JS -->
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Template Functions -->
<script src="../assets/js/functions.js"></script>

</body>


</html>