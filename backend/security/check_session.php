<?php 
    session_start();
    if(!$_SESSION['user']['customerId']){
        header("Location: http://".$_SERVER['SERVER_NAME'].'/student023/shop/backend/login.php') ;
    }
?>