<?php 
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Content-Type: application/json; charset=utf-8");
    
    $sql = "SELECT * FROM `023_products` WHERE isEnabled = 1;";
    include($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php');
    $result = mysqli_query($connect, $sql);
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($connect);

    echo json_encode($products);
?>