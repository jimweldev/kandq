<?php

$baseUrl = "./";
$page = "signIn";

include $baseUrl . "assets/templates/home/header.inc.php";

?>

<div class="py-5 px-4">
	<div class="container">

		<?= alert(); ?>
		
		<div class="row">
			<div class="col-lg-8 offset-lg-2">
				<div class="text-center mt-4">
					<h1 class="h2">Sign in!</h1>
					<p class="lead">
						Sign in to your account to continue
					</p>
				</div>

				<form action="<?= $baseUrl; ?>assets/includes/sessions.inc.php" method="POST">
					<div class="row">
						<div class="col-lg-6 offset-lg-3">
							<div class="mb-3">
								<label class="form-label">Username</label>
								<input class="form-control form-control-lg" type="text" placeholder="Enter your name" name="username" value="<?= value("username"); ?>">
							</div>

							<div class="mb-3">
								<label class="form-label">Password</label>
								<input class="form-control form-control-lg" type="password" placeholder="Enter your password" name="password">
							</div>
						</div>

						<div class="text-center mt-3">
							<button class="btn btn-lg btn-success" type="submit" name="signIn">Sign in</button>
						</div>
					</div>					
				</form>
			</div>
		</div>

	</div>
</div>

<?php

$baseUrl = "./";

include $baseUrl . "assets/templates/home/footer.inc.php";

?>