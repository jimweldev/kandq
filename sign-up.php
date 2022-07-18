<?php

$baseUrl = "./";
$page = "signUp";

include $baseUrl . "assets/templates/home/header.inc.php";

?>

<div class="py-5 px-4">
	<div class="container">

		<?= alert(); ?>
		
		<div class="row">
			<div class="col-lg-8 offset-lg-2">
				<div class="text-center mt-4">
					<h1 class="h2">Sign up!</h1>
					<p class="lead">
						Start creating the best possible user experience
					</p>
				</div>

				<form action="<?= $baseUrl; ?>assets/includes/sessions.inc.php" method="POST">
					<div class="row">
						<div class="col-lg-6">
							<div class="mb-3">
								<label class="form-label">Name</label>
								<div class="row g-3">
									<div class="col-lg-6">
										<input class="form-control form-control-lg" type="text" pattern="[a-zA-Z\s]+" title="Numbers and Symbols are not allowed" placeholder="First name" name="firstname" value="<?= value("firstname"); ?>" required>
									</div>
									<div class="col-lg-6">
										<input class="form-control form-control-lg" type="text" pattern="[a-zA-Z\s]+" title="Numbers and Symbols are not allowed" placeholder="Last name" name="lastname" value="<?= value("lastname"); ?>" required>
									</div>
								</div>
							</div>

							<div class="mb-3">
								<label class="form-label">Contact No</label>
								<input class="form-control form-control-lg" type="text" placeholder="Enter your contact no" value="<?= value("contactNo"); ?>" name="contactNo">
							</div>

							<div class="mb-3">
								<label class="form-label">Role</label>
								<select class="form-select form-select-lg" name="role">
									<option selected value="customer">Customer</option>
									<option value="seller">Seller</option>
								</select>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="mb-3">
								<label class="form-label">Username</label>
								<input class="form-control form-control-lg" type="text" pattern="[a-zA-Z0-9_.\-]{6,}" title="Only accepts letters, numbers, .(dot), -(dash), and underscore and atleast 6 or more characters" placeholder="Enter your username" name="username" value="<?= value("username"); ?>" required>
							</div>

							<div class="mb-3">
								<label class="form-label">Password</label>
								<input class="form-control form-control-lg" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Enter your password" name="password" required>
							</div>

							<div class="mb-3">
								<label class="form-label">Confirm Password</label>
								<input class="form-control form-control-lg" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Confirm password" name="confirmPassword" required>
							</div>
						</div>

						<div class="text-center mt-3">
							<button class="btn btn-lg btn-success" type="submit" name="signUp">Sign up</button>
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