<?php

$baseUrl = "../";
$page = "products";

include $baseUrl . "assets/templates/customer/header.inc.php";

?>

<h1 class="h3 mb-3">Chat</h1>

<?php

$customersId = $_SESSION["id"];
$sellersId = $_GET["id"];

$sql = "SELECT * FROM users WHERE id = $sellersId";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {

	echo "<div class='card'>";
		echo "<div class='card-header'>";
			echo "<h5 class='card-title mb-0'>" . $row["firstname"] . " " . $row["lastname"] . "</h5>";
		echo "</div>";

		echo "<div class='card-body d-flex flex-column' id='chat-window' style='height: 50vh; overflow-y: auto; width: 100%'>";
			
			$sql2 = "SELECT * FROM messages WHERE customers_id = $customersId AND sellers_id = $sellersId";
			$result2 = mysqli_query($conn, $sql2);

			if (mysqli_num_rows($result2) > 0) {

				while ($row2 = mysqli_fetch_assoc($result2)) {

					if ($row2["user_role"] == "customer") {
						
						echo "<div class='ms-auto mb-4' >";
							echo "<p class='text-muted text-end mb-2'>Me - <small class='text-muted'>Jan 2 | 4:00 PM</small></p>";

							echo "<div class='bg-primary text-white rounded ms-auto p-2' style='max-width: 60%; width: max-content;'>";
								echo $row2["message"];
							echo "</div>";
						echo "</div>";

					} else {

						echo "<div class='mb-4' >";
							echo "<p class='text-muted mb-2'>" . $row["firstname"] . " - <small class='text-muted'>Jan 2 | 4:00 PM</small></p>";

							echo "<div class='bg-success text-white rounded p-2' style='max-width: 60%; width: max-content;'>";
								echo $row2["message"];
							echo "</div>";
						echo "</div>";

					}

				}

			} else {

				echo "<p class='bg-success p-4 text-white text-center'>Send a message now!</p>";

			}

				

		echo "</div>";

		echo "<form class='card-footer input-group mb-3' action='" . $baseUrl . "assets/includes/customer/chat.inc.php' method='POST'>";
			echo "<input type='hidden' name='customersId' value='" . $customersId . "'>";
			echo "<input type='hidden' name='sellersId' value='" . $sellersId . "'>";
			echo "<input class='form-control' type='text' name='message'>";
			echo "<button class='btn btn-success input-group-text' name='sendMessage'>Send</button>";
		echo "</form>";
	echo "</div>";

}

?>

<?php

include $baseUrl . "assets/templates/customer/footer.inc.php";

?>
<script type="text/javascript">
	chatWindow = document.getElementById('chat-window'); 
	var xH = chatWindow.scrollHeight; 
	chatWindow.scrollTo(0, xH);
</script>