<?php 

$baseUrl = "../../";

include $baseUrl . "assets/includes/dbh.inc.php";

if (isset($_POST["signUp"])) {

	$firstname = mysqli_real_escape_string($conn, $_POST["firstname"]);
	$lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
	$address = "";
	$email = "";
	$contactNo = mysqli_real_escape_string($conn, $_POST["contactNo"]);
	$role = mysqli_real_escape_string($conn, $_POST["role"]);
	$username = mysqli_real_escape_string($conn, $_POST["username"]);
	$password = mysqli_real_escape_string($conn, $_POST["password"]);
	$confirmPassword = mysqli_real_escape_string($conn, $_POST["confirmPassword"]);
	
	$sql = "SELECT * FROM users WHERE username = '$username'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {

		header("Location: " . $baseUrl . "sign-up?error=Username is already taken&firstname=" . $firstname . "&lastname=" . $lastname . "&address=" . $address . "&contactNo=" . $contactNo . "&username=" . $username);
		exit();

	}

	if ($password != $confirmPassword) {
			
		header("Location: " . $baseUrl . "sign-up?error=Passwords mismatch&firstname=" . $firstname . "&lastname=" . $lastname . "&address=" . $address . "&contactNo=" . $contactNo . "&username=" . $username);
		exit();

	}

	$password = password_hash($password, PASSWORD_DEFAULT);

	$sql = "INSERT INTO users (firstname, lastname, address, email, contact_no, username, password, profile, role) VALUES ('$firstname', '$lastname', '$address', '$email', '$contactNo', '$username', '$password', 'avatar.png', '$role')";

	if (mysqli_query($conn, $sql)) {
		
		session_start();
		session_regenerate_id();
		$_SESSION["id"] = mysqli_insert_id($conn);
		$_SESSION["name"] = $firstname;
		$_SESSION["username"] = $username;
		$_SESSION["role"] = $role;
		session_write_close();

		$usersId = mysqli_insert_id($conn);

		$sql = "INSERT INTO complete_address (users_id, address, barangay, city, province, zip) VALUES ($usersId, '', '', '', '', '')";

		if (mysqli_query($conn, $sql)) {

			if ($_SESSION["role"] == "customer") {
				
				header("Location: " . $baseUrl . "customer");
				exit();

			} else if ($_SESSION["role"] == "seller") {

				header("Location: " . $baseUrl . "seller");
				exit();

			} else {

				header("Location: " . $baseUrl . "sign-up?error=Role error&firstname=" . $firstname . "&lastname=" . $lastname . "&address=" . $address . "&contactNo=" . $contactNo . "&username=" . $username);
				exit();

			}

		}

	}

	header("Location: " . $baseUrl . "sign-up?error=SQL error&firstname=" . $firstname . "&lastname=" . $lastname . "&address=" . $address . "&contactNo=" . $contactNo . "&username=" . $username);
	exit();

}

if (isset($_POST["signIn"])) {

	$username = mysqli_real_escape_string($conn, $_POST["username"]);
	$password = mysqli_real_escape_string($conn, $_POST["password"]);

	$sql = "SELECT * FROM users WHERE username = '$username'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {

		while ($row = mysqli_fetch_assoc($result)) {

			if (password_verify($password, $row["password"])) {
				
				session_start();
				session_regenerate_id();
				$_SESSION["id"] = $row["id"];
				$_SESSION["firstname"] = $row["firstname"];
				$_SESSION["username"] = $row["username"];
				$_SESSION["role"] = $row["role"];
				session_write_close();

				if ($_SESSION["role"] == "customer") {
			
					header("Location: " . $baseUrl . "customer");
					exit();

				} else if ($_SESSION["role"] == "seller") {

					header("Location: " . $baseUrl . "seller");
					exit();

				} else if ($_SESSION["role"] == "admin") {

					header("Location: " . $baseUrl . "admin");
					exit();

				} else {

					session_start();
					session_destroy();

					header("Location: " . $baseUrl . "sign-in?error=Role error&firstname=" . $firstname . "&lastname=" . $lastname . "&address=" . $address . "&contactNo=" . $contactNo . "&username=" . $username);
					exit();

				}

			}

			header("Location: " . $baseUrl . "sign-in?error=Incorrect password&username=" . $username);
			exit();

		}

	}

	header("Location: " . $baseUrl . "sign-in?error=Username not found&username=" . $username);
	exit();

}

if (isset($_GET["signOut"])) {
	
	session_start();
	session_destroy();

	header("Location: " . $baseUrl);
	exit();

}