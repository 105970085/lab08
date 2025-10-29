<?php
session_start();
require_once("settings.php");

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

$username = $_SESSION['username'];
$new_email = trim($_POST['email']);


$query = "UPDATE user SET email = '$new_email' WHERE username = '$username'";
if (mysqli_query($conn, $query)) {
  
  header("Location: profile.php");
  exit();
} else {
  echo "❌ Failed to update email: " . mysqli_error($conn);
}
?>
