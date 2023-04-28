<?php
session_start();
if (isset($_SESSION['username'])) {
	header('Location: dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'templates/header.php' ?>
	<title>Login - Barangay Management System</title>

	<style type="text/css">
		.form-floating-label .form-control.filled+.placeholder {
			color: black !important;
		}

		.login {
			/* Created with https://www.css-gradient.com */
			background: #010101;
			background: -webkit-linear-gradient(top left, #010101, #142C36);
			background: -moz-linear-gradient(top left, #010101, #142C36);
			background: linear-gradient(to bottom right, #010101, #142C36);
		}
	</style>

<body class="login">
	<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper wrapper-login">

		<div class="container container-login animated fadeIn">
			<?php if (isset($_SESSION['message'])) : ?>
				<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success'] == 'danger' ? 'bg-danger text-light' : null ?>" role="alert">
					<?= $_SESSION['message']; ?>
				</div>
				<?php unset($_SESSION['message']); ?>
			<?php endif ?>
			<!-- <h3 class="text-center">Log In</h3> -->
			<div class="login-form">
				<form method="POST" action="model/login.php">
					<div class="form-group form-floating-label">
						<img src="assets/uploads/28122022062802LOGO.png" class="img-fluid mb-5" alt="...">
						<h3 class="text-center">Log In</h3>
					</div>
					<div class="form-group form-floating-label">
						<input id="username" name="username" type="text" class="form-control input-border-bottom" required>
						<label for="username" class="placeholder">Username</label>
					</div>
					<div class="form-group form-floating-label">
						<input id="password" name="password" type="password" class="form-control input-border-bottom" required>
						<label for="password" class="placeholder">Password</label>
						<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
					</div>
					<div class="form-action mb-3">
						<button type="submit" class="btn btn-rounded btn-login" style="background-color: black; color: white;">Sign In</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php include 'templates/footer.php' ?>
</body>

</html>