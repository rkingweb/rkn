<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require '../../dbconn.php';

// Check if the user role is admin
session_start();
if($_SESSION['role'] !== 'admin'){
  echo "You do not have permission to add a new user";
  exit();
}

if(isset($_POST['submit'])) {
	// Get form data
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
    $role = $_POST['role'];

	// Prepare and bind statement
	$stmt = $conn->prepare("INSERT INTO user_info (usern, passw, usermail, urole) VALUES (?, ?, ?, ?)");
	$stmt->bind_param("ssss", $username, $password, $email, $role);

	// Execute statement
	if ($stmt->execute() === TRUE) {
        echo "New user added successfully! You will be redirected to dashboard in <span id='countdown'>5</span> seconds.";
        echo "<script>
        var seconds = 5;
        var countdown = setInterval(function() {
        seconds--;
        document.getElementById('countdown').textContent = seconds;
        if (seconds <= 0) {
            clearInterval(countdown);
            window.location = '../../index.php';
        }
        }, 1000);
        </script>";

    } else {
        echo "Error: " . $stmt->error;
    }
    

	// Close statement and connection
	$stmt->close();
	$conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add User</title>
</head>
<body>
	<h1>Add User</h1>
	<form method="post" action="">
		<label for="username">Username:</label>
		<input type="text" name="username" required><br><br>
		<label for="password">Password:</label>
		<input type="password" name="password" required><br><br>
		<label for="email">Email:</label>
		<input type="email" name="email" required><br><br>
        <label for="role">User Role</label>
        <select name="role" id="role">
        <option value="admin">Administrator</option>
        <option value="user">User</option>
        </select>

		<input type="submit" name="submit" value="Add User">
	</form>
</body>
</html>
