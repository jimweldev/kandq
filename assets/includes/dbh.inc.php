<?php 

$conn = mysqli_connect("localhost", "root", "", "carms");
// $conn = mysqli_connect("localhost", "id18368872_kandq_unam", "Jimwel123!!!", "id18368872_kandq_name");

if (!$conn) {
	die("connection failed: " . mysqli_connect_errno());
	die("connection failed: " . mysqli_connect_error());
}

include "functions.inc.php";