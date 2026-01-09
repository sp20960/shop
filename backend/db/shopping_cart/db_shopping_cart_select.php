<?php 
//FETCH CUSTOMER INFORMATION
$customerId = $_SESSION['user']['customerId'];

//QUERY TO GET INFORMATION ABOUT THE PRODUCTS WE HAVE IN OUR SHOPPING CART
$sql = "SELECT * 
        FROM `023_shopping_carts` AS sc 
        INNER JOIN `023_products` AS pr ON sc.productId = pr.productId  
        WHERE customerId = $customerId;";

require($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php');
$result = mysqli_query($connect, $sql);

$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_close($connect);
?>