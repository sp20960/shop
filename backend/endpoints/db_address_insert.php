<?php 
    session_start();
    if(isset($_POST['addAddress'])){
        $name = $_POST['name'];
        $lastName = $_POST['lastName'];
        $address = $_POST['address'];
        $additionalData = $_POST['additionalData'];
        $province = $_POST['province'];
        $city = $_POST['city'];
        $zipCode = $_POST['zipCode'];
        print_r($_POST);

        $sql = "INSERT INTO 023_addresses (`name`, lastName, `address`, additionalData, zipCode, city, province)
                VALUES ('$name', '$lastName', '$address', '$additionalData', $zipCode, '$city', '$province')  RETURNING addressId;";
        include($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php');
        $result = mysqli_query($connect, $sql);
        $returnedValues = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        $customerId = $_SESSION['user']['customerId'];
        $addressId = $returnedValues[0]['addressId'];

        $sql = "INSERT INTO 023_customers_addresses (customerId, addressId) VALUES($customerId, $addressId);";
        mysqli_query($connect, $sql);
        mysqli_close($connect);
    }
    header("Location: http://".$_SERVER['SERVER_NAME'].'/student023/shop/views/profile.html');

?>