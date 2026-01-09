  <?php 
    session_start();
    if (isset($_POST['productId']) && isset($_POST['quantity'])){
        $quantity = $_POST['quantity'];
        $productId = $_POST['productId'];
        $customerId = $_SESSION['user']['customerId'];

        $sql = "UPDATE `023_shopping_carts` 
                SET quantity = $quantity 
                WHERE productId = $productId AND customerId = $customerId;";
        require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/config/db_connect.php');
        $result = mysqli_query($connect, $sql);
        
        $sql = "SELECT subtotal FROM `023_shopping_carts_view` WHERE customerId = $customerId;";
        $result = mysqli_query($connect, $sql);
        mysqli_close($connect);
        $cart = mysqli_fetch_all($result, MYSQLI_ASSOC);

        echo json_encode($cart);
    }
?>