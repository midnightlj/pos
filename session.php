<?php
session_start();

if (!isset($_SESSION['user_name'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['user_name']);
  header("location: login.php");
}

$user_id = $_SESSION['user_id'];
$user_first_name = $_SESSION['first_name'];
$user_last_name = $_SESSION['last_name'];
$user_name = $_SESSION['user_name'];
$user_prefix = $_SESSION['user_prefix'];
$user_code = $_SESSION['user_code'];
$user_access = $_SESSION['user_access'];


// $userloginidqry="SELECT * FROM users
// WHERE user_name ='$usernamelogin'";

// $userloginidres=mysqli_query($db, $userloginidqry);
// while ($regdata=mysqli_fetch_assoc($userloginidres)) {
// $login_user=$regdata['user_id'];
// $useraccess=$regdata['user_access'];
// $username = $regdata['user_name'];
// }
?>
