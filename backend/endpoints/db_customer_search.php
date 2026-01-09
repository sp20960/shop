<?php 
    if (isset($_POST['userInput'])){
        $userInput = $_POST['userInput'];
        if(strlen($userInput) == 0){
          $sql = "SELECT * FROM `023_customers` LIMIT 20;";
        }else {
          $sql = "SELECT * FROM `023_customers` WHERE email LIKE '%$userInput%';";
        }

        include($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php');
        $result = mysqli_query($connect, $sql);
        $customers = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_close($connect);
        echo json_encode($customers);
    }
?>