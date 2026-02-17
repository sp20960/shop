<?php
$sql = "SELECT *
        FROM `023_orders_view`
        ORDER BY insertedOn DESC
        LIMIT 20;
        ";
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php';

$result = mysqli_query($connect, $sql);
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_close($connect);
?>