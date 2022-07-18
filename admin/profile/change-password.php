<?php

$baseUrl = "../../";
$page = "profile";

include $baseUrl . "assets/templates/admin/header.inc.php";

?>

<h1 class="h3 mb-3">Profile</h1>

<?php

echo "<div class='card'>";
	echo "<div class='card-body'>";
		echo "<div class='row'>";
			echo "<div class='col-lg-4'>";
				echo "<div class='list-group'>";
					echo "<a href='" . $baseUrl . "admin/profile' class='list-group-item list-group-item-action'>
					Update Profile
					</a>";
					echo "<a href='" . $baseUrl . "admin/profile/complete-address' class='list-group-item list-group-item-action'>Complete Address</a>";
					echo "<a href='" . $baseUrl . "admin/profile/change-password' class='list-group-item list-group-item-action active'>Change Password</a>";
				echo "</div>";
			echo "</div>";

			echo "<div class='col-lg-8'>";
				echo "<h5 class='card-title mb-4'>Complete Address</h5>";

				echo "<form action='" . $baseUrl . "assets/includes/admin/profile.inc.php' method='POST' enctype='multipart/form-data'>";
					echo "<div class='mb-3'>";
						echo "<label class='form-label'>Old Password</label>";
						echo "<input class='form-control form-control-lg' type='password' placeholder='Enter your old password' name='oldPassword'>";
					echo "</div>";

					echo "<div class='mb-3'>";
						echo "<label class='form-label'>New Password</label>";
						echo "<input class='form-control form-control-lg' type='password' placeholder='Enter your new password' name='newPassword'>";
					echo "</div>";

					echo "<div class='mb-3'>";
						echo "<label class='form-label'>Confirm Password</label>";
						echo "<input class='form-control form-control-lg' type='password' placeholder='Confrim new password' name='confirmPassword'>";
					echo "</div>";

					echo "<div class='text-center mt-3'>";
						echo "<button class='btn btn-lg btn-success' type='submit' name='updatePassword'>Update</button>";
					echo "</div>";
				echo "</form>";
			echo "</div>";
		echo "</div>";
	echo "</div>";
echo "</div>";

?>

<?php

include $baseUrl . "assets/templates/admin/footer.inc.php";

?>