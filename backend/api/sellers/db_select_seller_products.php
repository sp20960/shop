<?php 

header('Content-Type: application/json; charset=utf-8');

if(isset($_GET['apiKey'])){
  $apiKey = $_GET['apiKey'];

  $sql = "SELECT * 
          FROM `023_sellers`
          WHERE apiKey='$apiKey';";

  require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php';

  $result = mysqli_query($connect, $sql);
  $sellerInfo = mysqli_fetch_all($result, MYSQLI_ASSOC);

  if(!isset($sellerInfo[0])){
    mysqli_close($connect);
    http_response_code(401);
    echo json_encode(["error" => "API key inválida"]);
  }
  
  $sellerId = $sellerInfo[0]['sellerId'];

  $sql = "SELECT p.*
          FROM `023_sellers_products` AS sp
          INNER JOIN `023_products` AS p
          ON sp.productId = p.productId
          WHERE sp.sellerId = '$sellerId';";
  
  $result = mysqli_query($connect, $sql);
  $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

  echo json_encode($products);
}else {
  http_response_code(401);
  echo json_encode(["error" => "API key invalida"]);
}
?>