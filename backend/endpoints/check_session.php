<?php 
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Content-Type: application/json; charset=utf-8");
    session_start();
    if(!isset($_SESSION['user'])){
        echo "false";
    }else {
      echo "true";
    }

?>