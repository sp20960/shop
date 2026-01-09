<?php 
    if (isset($_GET['productName'])){
        $productName = $_GET['productName'];

        $sql = "SELECT * FROM `023_products` WHERE productName LIKE '%$productName%';";
        include($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php');
        $result = mysqli_query($connect, $sql);
        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_close($connect);
        echo json_encode($products);
    }
?>