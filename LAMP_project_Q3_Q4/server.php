<?php
  session_start();
  $username = "";
  $password_1 = "";
  $password_2 = "";
  $errors = array();

  // connect to database
  $db = new mysqli('localhost', 'root', '', 'registration');

  // of the register button is clicked
  if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];

    if (empty($username)) {
      array_push($errors, "Username is required");
    }
    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
      array_push($errors, "Username is invalid! Username must be your email");
    }
    if (empty($password_1)) {
      array_push($errors, "Password is required");
    }
    if ($password_1 !== $password_2) {
      array_push($errors, "Do not match password");
    }

    if (count($errors) === 0) {
      array_push($success, "You created an account successful!");
      $sql = "INSERT INTO `usersPizza` ( `ID`, `username`, `password`) VALUES (NULL, '$username', '$password_1')";
      mysqli_query($db,$sql);
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";
      
    }
  }

?>