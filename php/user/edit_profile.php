<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('../../dbconn.php');

// check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../../index.php");
    exit();
}


// Get the ID of the user whose information is being edited

$id = $_GET['id'];

// Check if the logged-in user has the permission to edit the specified user's information
if ($_SESSION['id'] != $id) {
    echo "Error: You do not have permission to edit this user's information.";
    echo "<p>You will be redirected to dashboard in <span id='countdown'>5</span> seconds.</p>";
    echo "<script>
            var timeLeft = 5;
            var countdown = setInterval(function(){
                timeLeft--;
                document.getElementById('countdown').textContent = timeLeft;
                if(timeLeft == 0) {
                    clearInterval(countdown);
                    window.location.href = '../../dashboard.php';
                }
            }, 1000);
        </script>";
    exit;
}



// Proceed with editing the user's information

// get the user record to edit
$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user_info WHERE id='$id'"));

// check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get updated values from form
    $newUsern = $_POST['usern'];
    $newPassw = $_POST['passw'];
    $newUsermail = $_POST['usermail'];

    // update the record in the database
    $query = "UPDATE user_info SET usern='$newUsern', passw='$newPassw', usermail='$newUsermail' WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        header("Location: ../../dashboard.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User Info</title>
</head>
<body>
    <h2>Edit User Info</h2>
    <form method="POST">
        <label for="usern">Username:</label><br>
        <input type="text" id="usern" name="usern" value="<?php echo $row['usern']; ?>"><br>
        <label for="passw">Password:</label><br>
        <input type="password" id="passw" name="passw" value="<?php echo $row['passw']; ?>"><br>
        <label for="usermail">Email:</label><br>
        <input type="email" id="usermail" name="usermail" value="<?php echo $row['usermail']; ?>"><br>
        <input type="submit" value="Save Changes">
    </form>
</body>

</html>
