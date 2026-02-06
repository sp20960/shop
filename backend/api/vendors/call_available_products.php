<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/products_functions.php';
$sqlVendors = "SELECT *
               FROM `023_vendors`;";
                  
require_once $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php';

$vendors = mysqli_fetch_all(mysqli_query($connect, $sqlVendors), MYSQLI_ASSOC);
mysqli_close($connect);

foreach ($vendors as $vendor):
  $vendorId = $vendor['vendorId'];
  $apiKey = $vendor['apiKey'];
  $endpoint = $vendor['api_endpoint_products']."?apiKey=$apiKey";

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $endpoint);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $jsonData = curl_exec($ch);
  $products = json_decode($jsonData, true);
  
  foreach($products['products'] as $product):
    insertProductVendor($product, $vendorId);
  endforeach;

endforeach;

?>