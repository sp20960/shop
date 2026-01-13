<?php

$sql="SELECT *
      FROM `023_shipping_methods`;";

require($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php');

$result = mysqli_query($connect, $sql);
$shippingMethods = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>