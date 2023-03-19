<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require '../../dbconn.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['id'])) {
	header('Location: ../php/user/login.php');
	exit;
}

// Check if user has admin role
if ($_SESSION['role'] !== 'admin') {
    echo "Error: You do not have permission to edit users.";
    exit;
}

// Get list of users
$stmt = $conn->prepare("SELECT id, usern FROM user_info");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit User</title>
</head>
<body>
	<h1>Edit User</h1>
	<form method="post" action="">
		<label for="user_id">Select user to edit:</label>
		<select name="user_id" id="user_id">
			<?php while ($row = $result->fetch_assoc()) { ?>
				<option value="<?php echo $row['id']; ?>"><?php echo $row['usern']; ?></option>
			<?php } ?>
		</select>
		<br><br>
		<label for="usern">Username:</label>
		<input type="text" name="usern" id="usern" required>
		<br><br>
		<label for="usermail">Email:</label>
		<input type="email" name="usermail" id="usermail" required>
		<br><br>
		<label for="role">Role:</label>
		<select name="role" id="role">
			<option value="user">User</option>
			<option value="admin">Admin</option>
		</select>
		<br><br>
		<input type="submit" name="submit" value="Edit User">
	</form>
	<script>
		// Countdown timer function
		function countdown() {
			var timeLeft = 5;
			var countdownTimer = setInterval(function() {
				if (timeLeft <= 0) {
					clearInterval(countdownTimer);
					window.location.href = "../dashboard.php";
				} else {
					document.getElementById("countdown").innerHTML = "You will be redirected to dashboard in " + timeLeft + " seconds.";
				}
				timeLeft -= 1;
			}, 1000);
		}

		// Auto-select user from dropdown list if user_id parameter is passed in URL
		var urlParams = new URLSearchParams(window.location.search);
		var userId = urlParams.get("user_id");
		if (userId) {
			document.getElementById("user_id").value = userId;
			// Get selected user's information and fill form fields
			var request = new XMLHttpRequest();
			request.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var user = JSON.parse(this.responseText);
					document.getElementById("usern").value = user.usern;
					document.getElementById("usermail").value = user.usermail;
					document.getElementById("role").value = user.role;
				}
			};
			request.open("GET", "get_user.php?id=" + userId, true);
			request.send();
		}

		// Submit form
