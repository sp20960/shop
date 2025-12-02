<?php 
  session_start();
    if (isset($_POST['updateAddress'])){

        //GET DATA
        $customerId = $_SESSION['user']['customerId'];
        $name = $_POST['name'];
        $lastName = $_POST['lastName'];
        $addressId = $_POST["addressId"];
        $address = $_POST["address"];
        $additionalData = $_POST["additionalData"];
        $province = $_POST["province"];
        $city = $_POST["city"];
        $zipCode = $_POST["zipCode"];

        //START DB CONNECTION
        include($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php');

        //DELETE QUERY
        $sql = "UPDATE 023_addresses 
                SET `name` = '$name',
                    lastName = '$lastName',
                    `address` = '$address',
                    additionalData = '$additionalData',
                    zipCode = '$zipCode',
                    city = '$city',
                    province = '$province' 
                WHERE addressId = $addressId; ";

        mysqli_query($connect, $sql);

        if($_POST['isDefault'] == "on"){
          $sql = "SELECT *
                  FROM 023_customers_addresses
                  WHERE customerId = $customerId AND isDefault = 1
                  LIMIT 1;";
          $query = mysqli_query($connect, $sql);
          $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
          if(isset($result[0]['customerId'])){
            $addressIdPrev = $result[0]['addressId'];
            $sql = "UPDATE 023_customers_addresses
                    SET isDefault = 0
                    WHERE customerId = $customerId AND addressId = $addressIdPrev;";
            mysqli_query($connect, $sql);
          }
          
          $sql = "UPDATE 023_customers_addresses
                  SET isDefault = 1
                  WHERE addressId = $addressId AND customerId = $customerId";

          mysqli_query($connect, $sql);
        } else {
          $sql = "UPDATE 023_customers_addresses
                  SET isDefault = 0
                  WHERE addressId = $addressId AND customerId = $customerId;";

          mysqli_query($connect, $sql);
        }

        //CLOSE DB CONEXION
        mysqli_close($connect);   
    }

    if (isset($_POST['deleteAddress'])){

        //GET DATA
        $addressId = $_POST["addressId"];

        //START DB CONNECTION
        include($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php');

        //DELETE QUERY
        $sql = "DELETE FROM 023_customers_addresses
                WHERE addressId = $addressId;";

        mysqli_query($connect, $sql);

        $sql = "DELETE FROM 023_addresses
                WHERE addressId = $addressId;";

        mysqli_query($connect, $sql);

        //CLOSE DB CONEXION
        mysqli_close($connect);   
    }
    header("Location: http://".$_SERVER['SERVER_NAME'].'/student023/shop/views/profile.html');

?>