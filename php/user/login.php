<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
if(isset($_SESSION['username'])) {
    header("Location: ../../dashboard.php");
    exit();
}

require '../../dbconn.php';

if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user_info WHERE usern = '$username' AND passw = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // Set session variables
      $row = $result->fetch_assoc();
      $_SESSION['id'] = $row['id'];
      $_SESSION['username'] = $row['usern'];
      $_SESSION['usermail'] = $row['usermail'];
      $_SESSION['role'] = $row['urole'];

      header("Location: ../../dashboard.php");
    } else {
      header("Location: ../../index.php?error=1");
    }
} else {
    header("Location: .../index.php");
}

$conn->close();
?>
