<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$errors = [];

if (isset($_POST['submit'])) {
  // INITIALIZE SESSION
  session_regenerate_id();

  // FETCH POST INFORMATION
  $email = $_POST['email'];
  $pwd = $_POST['pwd'];

  if (empty($pwd)) {
    $errors['pwd'] = "Este campo es obligatorio!";
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Email incorrecto!";
  }

  if (empty($email)) {
    $errors['email'] = "Este campo es obligatorio!";
  }

  if (!array_filter($errors)) {
    // CREATE QUERY

    $sql = "SELECT * FROM `023_customers` WHERE email = '$email' AND pwd = '$pwd';";

    // OPEN CONNECTION
    require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/config/db_connect.php');

    // EXECUTE QUERY AND SAVE RESULT
    $result = mysqli_query($connect, $sql);
    mysqli_close($connect);

    $user = mysqli_fetch_assoc($result);
    // CHECK IF CUSTOMER EXISTS
    if ($user) {
      $_SESSION['user'] = $user;

      //Log insert
      $file = $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/logs/log_in_log.txt';
      $message = "\n".date("c", time()).'--'.'Customer Id: '.$_SESSION['user']['customerId'].' Logged in';
      $handle = fopen($file, 'a+');
      fwrite($handle, $message);
      fclose($handle);

      if($_SESSION['user']['rol'] == 'admin'){
        header("Location: http://" . $_SERVER['SERVER_NAME'] . '/student023/shop/backend/index.php');        
      }else{
        header("Location: http://" . $_SERVER['SERVER_NAME'] . '/student023/shop/views/profile.html');
      }
    } else {
      $errors['fail'] = "Email o contraseña incorrecto!";
    }
  }
}