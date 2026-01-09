<?php 
    session_start();
    if(!$_SESSION['user']){
        header("Location: http://".$_SERVER['SERVER_NAME'].'/student023/shop/backend/login.php') ;
    }
?>