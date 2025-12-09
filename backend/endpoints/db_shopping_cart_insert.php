<?php 
session_start();
if(isset($_GET['productId']) && isset($_SESSION['user'])) {
    //FETCH ALL THE NECESSARY INFORMATION
    $productId = $_GET['productId'];
    $customerId = $_SESSION['user']['customerId'];
    echo $productId;
    
    // SQL QUERY
    $sql = "SELECT * FROM `023_shopping_carts` WHERE productId = $productId AND customerId = $customerId;";

    //START DB CONNECTION
    require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/config/db_connect.php');

    // EXECUTE QUERY
    $checkResult = mysqli_query($connect, $sql);

    // CHECK IF ALREADY EXISTS THE PRODUCT IN THE SHOPPING CART
    if(mysqli_num_rows($checkResult) !== 1){
        // IF NOT ESXISTS INSERT 
        if(!isset($_GET['quantity'])):
          $sql = "INSERT INTO `023_shopping_carts`(customerId, productId, quantity) VALUES($customerId, $productId, 1);";
          //EXECUTE QUERY
        else:
          $quantity = $_GET['quantity'];
          $sql = "INSERT INTO `023_shopping_carts`(customerId, productId, quantity) VALUES($customerId, $productId, $quantity );";
        endif; 
        $result = mysqli_query($connect, $sql);
    } else {
        //IF EXISTS THE PRODUCT IN THE SHOPPING CART INCREMENT QUANTITY
        if(!isset($_GET['quantity'])):
          $sql = "UPDATE 023_shopping_carts SET quantity = quantity + 1 WHERE customerId = $customerId AND productId = $productId;";
        else:
          $quantity = $_GET['quantity'];
          $sql = "UPDATE 023_shopping_carts SET quantity = quantity + $quantity WHERE customerId = $customerId AND productId = $productId;";
        endif;
        $result = mysqli_query($connect, $sql);
    }
    //CLOSE DB CONNECTION
    mysqli_close($connect);
}

?>