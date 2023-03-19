<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

//to display an error
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connect to the database
require_once 'dbconn.php';

// Query the database
$result = mysqli_query($conn, "SELECT * FROM user_info");

// Fetch the data and store it in $row
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
    <link rel="stylesheet" href="style/style.css">

</head>
<body>
<p>Welcome, <?php echo $_SESSION['username']; ?></p>
    <p>Your email address: <?php echo $_SESSION['usermail']; ?></p>
    <a href="php/user/edit_profile.php?id=<?php echo $_SESSION['id']; ?>">Edit Profile</a>  
    <a href="php/user/logout.php">Logout</a>
   
    <?php if ($_SESSION['role'] === 'admin'): ?>
        <a href="php/user/delete_user.php">Delete</a>
        <a href="php/user/add_user.php">Add User</a>
        <a href="php/user/user_accounts.php">User Accounts</a>
       
    <?php endif; ?>



</body>
</html>
