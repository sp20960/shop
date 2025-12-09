<?php
session_start();

if (isset($_SESSION['user'])){
    if ($_SESSION['user']['rol'] == "customer"){
        header("Location: http://".$_SERVER['SERVER_NAME'].'/student023/shop/views/profile.html') ;
    } else if($_SESSION['user']['rol'] == "admin") {
        header("Location: http://".$_SERVER['SERVER_NAME'].'/student023/shop/backend/') ;
    }
}

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
      if($_SESSION['user']['rol'] == 'admin'){
        header("Location: http://" . $_SERVER['SERVER_NAME'] . '/student023/shop/backend/index.php');        
      }else{
        header("Location: http://" . $_SERVER['SERVER_NAME'] . '/student023/shop/views/profile.html');
      }
      // REDIRECT USER TO THE ADMINISTRATOR PANEL
    } else {
      // REDIRECT USER TO THE LOGIN
      $errors['fail'] = "Email o contraseña incorrecto!";
    }
  }
}