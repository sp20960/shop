<?php
  session_start();

  if(isset($_POST['submit']) && $_SESSION['user']['insertOrder'] == "true") {
    include($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php');

    $customerId = $_SESSION['user']['customerId'];
    $insertedOn = date('Y-m-d h:i:s', time());
    $paymentId = $_SESSION['user']['paymentId'];
    $transactionId = time();
    $shippingId = $_SESSION['user']['shippingId'];
    $addressId = $_SESSION['user']['addressId'];
    $_SESSION['user']['transactionId'] = $transactionId;
    $orderNumber = mysqli_fetch_all(mysqli_query($connect, "SELECT UUID()"), MYSQLI_ASSOC)[0]['UUID()'];

    $sqlInsert = "INSERT INTO `023_orders` (`vendorId`, `orderNumber`, `customerId`, `productId`, `quantity`, `productUnitPrice`, `insertedOn`, `paymentId`, `transactionId`, `addressId`, `shippingId`)
            SELECT 
            `vendorId`,
            '$orderNumber',
            `customerId`, 
            `productId`, 
            `quantity`,
            `pricePerUnit`,
            '$insertedOn',
            $paymentId,
            '$transactionId',
            $addressId,
            $shippingId
            FROM `023_shopping_carts_view`
            WHERE customerId = $customerId
            RETURNING orderNumber;
    ";
    if($result = mysqli_query($connect, $sqlInsert)){
    

      //Empty customer shopping cart
      $orderNumber = mysqli_fetch_all($result, MYSQLI_ASSOC)[0]['orderNumber'];

      $sqlDeleteCart = "DELETE FROM `023_shopping_carts` 
                  WHERE customerId=$customerId;";
      mysqli_query($connect, $sqlDeleteCart);

      //Get subtotal
      $sqlSelectInfo = "SELECT subtotal, productUnitPrice, quantity, productName 
                    FROM `023_orders_view`
                    WHERE orderNumber='$orderNumber';";
      $result = mysqli_query($connect, $sqlSelectInfo);

      $ordersInfo = mysqli_fetch_all($result, MYSQLI_ASSOC);
      // Calculate subtotal
      $total = 0;
      foreach($ordersInfo as $subtotal){
        $total += $subtotal['subtotal'];
      }
      // Set subtotal in SESSION super global
      $_SESSION['user']['total'] = $total;
      mysqli_close($connect);

      // Check if any product belongs to a vendor
      require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/orders_functions.php';
      apiOrderInsert($orderNumber);
      
      //Send mail
      ob_start();
      require __DIR__.'/../../templates/mail/order_confirmation.php';
      $body = ob_get_clean();

      include __DIR__. '/../../includes/mail_functions.php';
      sendMail($_SESSION['user']['email'], 'Pedido confirmado Riff Store', $body);

      // Redirect to confirmation message;
      header("Location: http://" . $_SERVER['SERVER_NAME'] . '/student023/shop/backend/checkout/confirmation.php');
    }  
  }
?>