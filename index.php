<?php
session_start();
if(isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="style/form.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="container">
	<form method="POST" action="php/user/login.php">
		<h1>Login</h1>
		<!-- <label for="username" class="visually-hidden">Username</label> -->
		<input type="text" name="username" placeholder="Username">
		<!-- <label for="password" class="visually-hidden">Password</label> -->
		<input type="password" name="password" placeholder="Password">
		<button type="submit" name="submit">Login</button>
		<?php 
			if(isset($_GET['error']) && $_GET['error'] == 1) {
			echo "<p style='color: red'>Invalid username or password</p>";
			}
		?>
	</form>
	
</body>
</html>



