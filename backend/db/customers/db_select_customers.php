<?php
$sql = "SELECT *
        FROM `023_customers`
        LIMIT 20;
        ";
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php';

$result = mysqli_query($connect, $sql);
$customers = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_close($connect);
?>