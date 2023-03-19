<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "php/user/login.php called";
print_r($_POST);


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
	<link rel="stylesheet" href="style/form1.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="container">
	<form method="POST" action="php/user/login.php" id="login-form">
		<h1>Login</h1>
		<label for="username" id="username-label"></label>
  <input type="text" name="username" id="username-input">
  <label for="password" id="password-label" class="hidden"></label>
  <input type="password" name="password" id="password-input" class="hidden">
  <button type="submit" name="submit" id="submit-button" class="hidden">Submit</button>

		<?php 
			if(isset($_GET['error']) && $_GET['error'] == 1) {
			echo "<p style='color: red'>Invalid username or password</p>";
			}
		?>
	</form>
    <script src="style/logform.js"></script>

</body>
</html>



