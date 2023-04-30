<?php
session_start();

$username = "";
// $email    = "";


$errors = array();

// connect to the database

$db = mysqli_connect('localhost', 'root', '', 'pcbm');
if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    if(isset($_POST['submit'])) {

        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if (empty($username)) {
          array_push($errors, "Username is required");
        }
        if (empty($password)) {
          array_push($errors, "Password is required");
        }

        if (count($errors) == 0)
        {
          $password = sha1($password);
          if (sha1($_POST['password']) !== $password) {
              echo "Incorrect Password!";
        }

        $query = "SELECT * FROM users WHERE user_name='$username' AND password ='$password'";




    		$sql = "SELECT * FROM users WHERE user_name='$username' AND password ='$password'";
    		$result = mysqli_query($db, $sql);
    		$row = mysqli_fetch_assoc($result);

          $results = mysqli_query($db, $query);
          $res=mysqli_num_rows($results);
          if ($res)
          {
            $_SESSION['user_id'] = $row["user_id"];
            $_SESSION['user_name'] = $username;
            $_SESSION['first_name'] =$row["first_name"];
            $_SESSION['last_name'] =$row["last_name"];
            $_SESSION['user_code'] =$row["user_code"];
            $_SESSION['user_prefix'] =$row["user_prefix"];
            $_SESSION['user_access'] =$row["user_access"];
            header('location: index.php');
          }
          else {
            array_push($errors, "Incorrect Username / Password!");
          }
        }

      }
?>
