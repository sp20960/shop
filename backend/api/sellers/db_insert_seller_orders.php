<?php 

header('Content-Type: application/json');

if(isset($_GET['apiKey']) && isset($_GET['orderContent'])){

  $apiKey = $_GET['apiKey'];
  $orderContent = json_decode($_GET['orderContent'], true);
  $sqlCheckSeller = "SELECT *
                    FROM `023_sellers`
                    WHERE apiKey = '$apiKey';";

  require_once $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php';
  
  $sellerInfo = mysqli_fetch_all(mysqli_query($connect, $sqlCheckSeller), MYSQLI_ASSOC);

  if(!isset($sellerInfo[0])){
    http_response_code(401);
    echo json_encode("{error: 'Invalid api key'}");
    die();
  }
  $customerName = $orderContent['customerName'];
  $customerLastName = $orderContent['customerLastName'];
  $country = $orderContent['address']['country'];
  $address = $orderContent['address']['address'];
  $zipCode = $orderContent['address']['zipCode'];
  $city = $orderContent['address']['city'];
  $province = $orderContent['address']['province'];

  $sqlInsertAddress = "INSERT INTO `023_addresses`(`name`, `lastName`, `country`, `address`, `zipCode`, `city`, `province`) 
                        VALUES ('$customerName','$customerLastName','$country','$address',$zipCode, '$city','$province') RETURNING addressId;";

  $resultInsertAddress = mysqli_fetch_all(mysqli_query($connect, $sqlInsertAddress), MYSQLI_ASSOC);

  if(!isset($resultInsertAddress[0])){
    mysqli_close($connect);
    http_response_code(401);
    echo json_encode("{error: 'json fields incorrect'}");
    die();
  }
  
  $addressId = $resultInsertAddress[0]['addressId'];
  $sellerId = $sellerInfo[0]['sellerId'];
  $productId = $orderContent['productId'];
  $quantity = $orderContent['quantity'];
  $productUnitPrice = $orderContent['productUnitPrice'];
  $customerPhone = $orderContent['customerPhone'];
  $insertedOn = date('Y-m-d h:i:s', time());

  $sqlInsertOrder = "INSERT INTO `023_orders`(`productId`, `quantity`, `productUnitPrice`, `insertedOn` `paymentId`, `addressId`, `shippingId`, `sellerId`, `customerPhone`, `customerName`, `customerLastName`) 
                     VALUES ($productId, $quantity, $productUnitPrice, '$insertedOn', 1,$addressId, 1, '$sellerId', '$customerPhone','$customerName','$customerLastName') RETURNING orderNumber;";
  
  $resultInsertOrder = mysqli_fetch_all(mysqli_query($connect, $sqlInsertOrder), MYSQLI_ASSOC);

  if(!isset($resultInsertOrder[0])){
    mysqli_close($connect);
    http_response_code(401);
    echo json_encode("{error: 'json fields incorrect'}");
    die();
  }

  mysqli_close($connect);

  echo json_encode("{ok: true}");
}
?>