<?php
  session_start();
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'registration';
  $errors  = array();
  try {
    $connect = new PDO("mysql:host=$host; dbname=$database",$username,$password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(isset($_POST["login"])) {
      if(empty($_POST["username"])  || empty($_POST["password"])) {
        array_push($errors, "All fields is required");
      }
      else {
        $query = "SELECT * FROM usersPizza WHERE username = :username AND password = :password";
        $statement = $connect->prepare($query);
        $statement->execute(
          array(
            'username' => $_POST['username'],
            'password' => $_POST['password'] 
          )
          );
          $count = $statement->rowCount();
          if ($count > 0) {
            $_SESSION['username'] = $_POST['username'];
            header("location:loginSuccess.php");
          }
          else {
            array_push($errors, "Username or Password is wrong");
          }
      }
    }
  }
  catch (PDOException $error) {
    $errors = $error->getMessage();
  }
?>