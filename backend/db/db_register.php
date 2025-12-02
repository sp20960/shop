<?php
if(isset($_POST['register'])){
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $rePwd = $_POST['rePwd'];
    
    
    if(empty($email)){
      $errors['email'] = "Este campo es obligatorio";
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $errors['email'] = "Email incorrecto";
    }

    require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/customers_functions.php';
    $emailExist = checkEmailExist(trim($email));

    if($emailExist){
      $errors['email'] = "El email ya existe";
    }

    if(trim(strlen($pwd)) < 6){
      $errors['pwd'] = "Longitud mínima de 6 caracteres";
    }

    if(trim($pwd) != trim($rePwd)){
      $errors['rePwd'] = "Las contraseñas no coinciden";
    }

    if (count($errors) == 0){
      $sql = "INSERT INTO `023_customers`(email, pwd) 
              VALUES ('$email', '$pwd');";

      require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php';

      $result = mysqli_query($connect, $sql);

      if($result){
        header("Location: http://" . $_SERVER['SERVER_NAME'] . '/student023/shop/backend/login.php');
      } else {
        $errors[$db] = "No se ha podido completar la operación, intentelo mas tarde";
      }
    }
  }
?>