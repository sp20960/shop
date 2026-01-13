<?php
session_start();

  if(isset($_POST['submit']) && $_SESSION['user']['insertOrder'] == "true") {

    $customerId = $_SESSION['user']['customerId'];
    $insertedOn = date('Y-m-d h:i:s', time());
    $paymentId = 1;
    $transactionId = time();
    $shippingId = 1;
    $_SESSION['user']['transactionId'] = $transactionId;

    $sqlInsert = "INSERT INTO `023_orders` (`orderNumber`, `customerId`, `productId`, `quantity`, `productUnitPrice`, `insertedOn`, `paymentId`, `transactionId`, `addressId`, `shippingId`)
            SELECT 
            UUID(),
            `customerId`, 
            `productId`, 
            `quantity`,
            `pricePerUnit`,
            '$insertedOn',
            $paymentId,
            '$transactionId',
            (SELECT addressId FROM `023_customers_addresses` WHERE customerId=$customerId AND isDefault=1 LIMIT 1), $shippingId
            FROM `023_shopping_carts_view`
            WHERE customerId = $customerId
            RETURNING orderNumber;
    ";

    include($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php');

    if($result = mysqli_query($connect, $sqlInsert)){
      $orderNumber = mysqli_fetch_all($result, MYSQLI_ASSOC)[0]['orderNumber'];
      $sqlDeleteCart = "DELETE FROM `023_shopping_carts` 
                  WHERE customerId=$customerId;";
      mysqli_query($connect, $sqlDeleteCart);

      $sqlSelect = "SELECT subtotal 
                    FROM `023_orders_view`
                    WHERE orderNumber='$orderNumber';";
      $result = mysqli_query($connect, $sqlSelect);


      $subtotals = mysqli_fetch_all($result, MYSQLI_ASSOC);

      $total = 0;
      foreach($subtotals as $subtotal){
        $total += $subtotal['subtotal'];
      }


      $_SESSION['user']['total'] = $total;
      mysqli_close($connect);

      header("Location: http://" . $_SERVER['SERVER_NAME'] . '/student023/shop/backend/checkout/confirmation.php');
    }  
  }
?>