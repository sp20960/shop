<?php 
session_start();

if(isset($_SESSION['user']['customerId']) && $_GET['productId']){
  $productId = $_GET['productId'];
  $customerId = $_SESSION['user']['customerId'];

  $sql = "DELETE 
          FROM `023_shopping_carts`
          WHERE customerId = $customerId 
          AND productId = $productId;";
  
  require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php';

  mysqli_query($connect, $sql);
  mysqli_close($connect);
}
?>