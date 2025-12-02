<?php 
session_start();
print_r( $_SESSION);
  if(isset($_POST['submit']) && $_SESSION['user']['insertOrder'] == 1) {

    unset($_SESSION['user']['insertOrder']);
    $customerId = $_SESSION['user']['customerId'];
    //IMPORTANTE HACER FUNCTION QUE DEVUELVA EL ULTIMO ID MAS UNO
    // $orderNumber = 1004;
    $insertedOn = date('Y-m-d h:i:s', time());
    $paymentId = 1;
    $transactionId = time();
    $shippingId = 1;
    $_SESSION['user']['transactionId'] = $transactionId;
    

    //IMPORTANT REFACTO THIS WHIT RETURNING VALUE ORDER NUMBER
    $sqlInsert = "INSERT INTO `023_orders` (`orderNumber`, `customerId`, `productId`, `quantity`, `productUnitPrice`, `insertedOn`, `paymentId`, `transactionId`, `addressId`, `shippingId`)
            SELECT 
            (SELECT MAX(orderNumber) + 1 FROM `023_orders`), 
            `customerId`, `productId`, `quantity`, `pricePerUnit`, '$insertedOn', $paymentId, '$transactionId',
            (SELECT addressId FROM `023_customers_addresses` WHERE customerId=$customerId AND isDefault=1 LIMIT 1), $shippingId
            FROM `023_shopping_carts_view`
            WHERE customerId = $customerId;
    ";


    $sqlDelete = "DELETE FROM `023_shopping_carts` 
                  WHERE customerId=$customerId;";
    include($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php');


    if(mysqli_query($connect, $sqlInsert)){
      mysqli_query($connect, $sqlDelete);
      $sqlSelect = "SELECT subtotal 
                    FROM `023_orders_view`
                    WHERE orderNumber=(SELECT MAX(orderNumber) FROM `023_orders`);";
      $result = mysqli_query($connect, $sqlSelect);
      $subtotals = mysqli_fetch_all($result, MYSQLI_ASSOC);
      $total = 0;
      foreach($subtotals as $subtotal){
        $total += $subtotal['subtotal'];
      }
      $_SESSION['user']['total'] = $total;
      header("Location: http://" . $_SERVER['SERVER_NAME'] . '/student023/shop/backend/checkout/confirmation.php');
    }  

  }

?>