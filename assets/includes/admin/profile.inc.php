<?php

$baseUrl = "../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

session_start();

if (isset($_POST["updateProfile"])) {

	$usersId = $_SESSION["id"];
	$firstname = mysqli_real_escape_string($conn, $_POST["firstname"]);
	$lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
	$contactNo = mysqli_real_escape_string($conn, $_POST["contactNo"]);
	$password = mysqli_real_escape_string($conn, $_POST["password"]);

	$sql = "SELECT * FROM users WHERE id = $usersId";
	$result = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_assoc($result)) {

		if (password_verify($password, $row["password"])) {
			
			if (empty($_FILES['image']['tmp_name'])) {

				$sql = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', contact_no = '$contactNo' WHERE id = $usersId";
				mysqli_query($conn, $sql);

				$_SESSION["firstname"] = $firstname;

				header("Location: " . $baseUrl . "admin/profile/?success");
				exit();

			} else {

				$fileName = $_FILES['image']['name'];
				$fileTmpName = $_FILES['image']['tmp_name'];

				$fileExt = explode(".", $fileName);
				$fileExt = strtolower(end($fileExt));

				$fileName = uniqid("", true) . "." . $fileExt;

				$fileDestination =  $baseUrl . "assets/uploads/profiles/" . $fileName;

				move_uploaded_file($fileTmpName, $fileDestination);

				$sql = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', contact_no = '$contactNo', profile = '$fileName' WHERE id = $usersId";
				mysqli_query($conn, $sql);

				$_SESSION["firstname"] = $firstname;

				header("Location: " . $baseUrl . "admin/profile/?success");
				exit();

			}

		} 

		header("Location: " . $baseUrl . "admin/profile/?error=Incorrect password");
		exit();

	}	

}

if (isset($_POST["updateAddress"])) {

	$usersId = $_SESSION["id"];
	$address = mysqli_real_escape_string($conn, $_POST["address"]);
	$barangay = mysqli_real_escape_string($conn, $_POST["barangay"]);
	$city = mysqli_real_escape_string($conn, $_POST["city"]);
	$province = mysqli_real_escape_string($conn, $_POST["province"]);
	$zip = mysqli_real_escape_string($conn, $_POST["zip"]);
	$password = mysqli_real_escape_string($conn, $_POST["password"]);

	$sql = "SELECT * FROM users WHERE id = $usersId";
	$result = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_assoc($result)) {

		if (password_verify($password, $row["password"])) {

			$sql = "UPDATE complete_address SET address = '$address', barangay = '$barangay', city = '$city', province = '$province', zip = '$zip' WHERE users_id = $usersId";
			mysqli_query($conn, $sql);

			header("Location: " . $baseUrl . "admin/profile/complete-address?success");
			exit();

		}

		header("Location: " . $baseUrl . "admin/profile/complete-address?error=Incorrect password");
		exit();

	}

}

if (isset($_POST["updatePassword"])) {

	$usersId = $_SESSION["id"];
	$oldPassword = mysqli_real_escape_string($conn, $_POST["oldPassword"]);
	$newPassword = mysqli_real_escape_string($conn, $_POST["newPassword"]);
	$confirmPassword = mysqli_real_escape_string($conn, $_POST["confirmPassword"]);

	if ($newPassword != $confirmPassword) {
		
		header("Location: " . $baseUrl . "admin/profile/change-password?error=Passwords Mismatch");
		exit();

	}

	$sql = "SELECT * FROM users WHERE id = $usersId";
	$result = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_assoc($result)) {

		if (password_verify($oldPassword, $row["password"])) {

			$password = password_hash($newPassword, PASSWORD_DEFAULT);

			$sql = "UPDATE users SET password = '$password' WHERE id = $usersId";
			mysqli_query($conn, $sql);

			header("Location: " . $baseUrl . "admin/profile/change-password?success");
			exit();

		}

		header("Location: " . $baseUrl . "admin/profile/change-password?error=Incorrect password");
		exit();

	}

}