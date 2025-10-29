<?php
session_start();
require_once("settings.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


$username = $_SESSION['username'];


$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}


$query = "SELECT * FROM user WHERE username='$username'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>

<h2>Welcome, <?php echo $user['username']; ?>!</h2>

<p><strong>Email:</strong> <?php echo $user['email']; ?></p>

<hr>

<h3>Edit Profile</h3>
<form action="update_profile.php" method="post">
  <input type="hidden" name="username" value="<?php echo $user['username']; ?>">
  <label>New Email:</label>
  <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
  <input type="submit" value="Update">
</form>


<p><a href="logout.php">Logout</a></p>
