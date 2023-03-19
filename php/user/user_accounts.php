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
    echo "Error: You do not have permission to view user accounts.";
    exit;
}

// Get list of users
$stmt = $conn->prepare("SELECT id, usern, usermail, urole FROM user_info");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
	<title>User Accounts</title>
</head>
<body>
	<h1>User Accounts</h1>
	<table>
		<tr>
			<th>User ID</th>
			<th>User Name</th>
			<th>User Email</th>
			<th>User Role</th>
		</tr>
		<?php while ($row = $result->fetch_assoc()) { ?>
		<tr>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['usern']; ?></td>
			<td><?php echo $row['usermail']; ?></td>
			<td><?php echo $row['urole']; ?></td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>
