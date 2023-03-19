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
    <script src="https://kit.fontawesome.com/fe8e9cfefb.js" crossorigin="anonymous"></script>

</head>
<body>
   
 <div class="wrapper">
  <nav class="sidebar">
    <div class="profile">
      <img src="style/img/profile.png" alt="Your profile">
      <p><?php echo $_SESSION['username']; ?></p>
      <p><?php echo $_SESSION['usermail']; ?></p>
    </div>
    <ul>
      <li>
        <a href="#">Dashboard</a>
      </li>
      <li>
        <a href="php/user/edit_profile.php?id=<?php echo $_SESSION['id']; ?>">Profile</a>
      </li>
      <li>
        <a href="php/user/logout.php">Logout</a></li>
          <li>
				<a href="#">About</a>
				<ul>
					<li><a href="#">Our Story</a></li>
					<li><a href="#">Meet the Team</a></li>
				</ul>
			</li>
    </ul>
    <?php if ($_SESSION['role'] === 'admin'): ?>
        <a href="php/user/delete_user.php">Delete</a>
        <a href="php/user/add_user.php">Add User</a>
        <a href="php/user/user_accounts.php">User Accounts</a>
    <?php endif; ?>
  </nav>
  <main class="content">
    <div class="pagecontent">trait_exists</div>
    <p>test</p>
  </main>
</div>



</body>
</html>
