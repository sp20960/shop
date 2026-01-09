<?php 
$sql = "SELECT r.*, p.productName, p.productId
        FROM `023_reviews` AS r
        INNER JOIN `023_products` AS p
        ON r.productId = p.productId
        WHERE isChecked = 0
        LIMIT 5;";
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php';
$result = mysqli_query($connect, $sql);
$reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_close($connect);
?>