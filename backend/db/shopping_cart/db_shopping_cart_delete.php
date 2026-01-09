<?php 
    require($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/admin_header.php');

    if(isset($_POST['submit'])){
         //GET DATA
        $productId = $_POST["productId"];
        $customerId = $_SESSION['user']['customerId'];

        //START DB CONNECTION
        include($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php');

        //DELETE QUERY
        $sql = "DELETE FROM `023_shopping_carts` 
            WHERE productId = $productId AND customerId = $customerId";

        if (mysqli_query($connect,$sql)){
          header("Location: http://".$_SERVER['SERVER_NAME'].'/student023/shop/backend/customer/my_shopping_cart.php?proc=successfull&msg=Producto+eliminado+correctamente');
        } else{
          header("Location: http://".$_SERVER['SERVER_NAME'].'/student023/shop/backend/customer/my_shopping_cart.php?proc=fail&msg=¡Ha+habido+un+problema!');
        }

        //CLOSE DB CONEXION
        mysqli_close($connect);   
    
    }
    require($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/footer.php')
?>