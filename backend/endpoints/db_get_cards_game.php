<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; utf8");
$sql = "SELECT *
        FROM `023_products`
        LIMIT 6;";

require $_SERVER['DOCUMENT_ROOT']. '/student023/shop/backend/config/db_connect.php';

$products = mysqli_fetch_all(mysqli_query($connect, $sql), MYSQLI_ASSOC);

$cardsJson = [];

foreach ($products as $product) {
  $cardsJson[] = ["src" => "http://localhost/".$product['imagePath'], "encontrada" => false]; 
}

echo json_encode($cardsJson);
?>