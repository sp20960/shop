<?php     
    if(isset($_POST['delete'])){
        //GET DATA
        $productId = $_POST["productId"];

        //START DB CONNECTION
        include($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php');

        //DELETE QUERY
        $sql = "DELETE FROM `023_products`
                WHERE productId = $productId";

       if(mysqli_query($connect, $sql))
        {
          mysqli_close($connect);   
          header("Location: http://".$_SERVER['SERVER_NAME'].'/student023/shop/backend/admin/products.php?proc=successfull&msg=Producto+eliminado+correctamente');
        } else{
          mysqli_close($connect);   
          header("Location: http://".$_SERVER['SERVER_NAME'].'/student023/shop/backend/admin/products.php?proc=fail&msg=¡Ha+habido+un+problema!');
        }                
    }
?>