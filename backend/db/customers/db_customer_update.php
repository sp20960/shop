<?php 
 if(isset($_POST['updateCustomer'])){
        $_SESSION['user']['formAction'] =  true;
        $customerId = $_SESSION['user']['customerId'];
        $firstName = $_POST['firstName'];
        $nif = $_POST['nif'];
        $phone = $_POST['phone'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];

        $sql = "UPDATE 023_customers
                SET firstName = '$firstName',
                    nif = '$nif',
                    phone = '$phone',
                    lastName = '$lastName',
                    email = '$email'
                WHERE customerId = $customerId;";
        include($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php');
        mysqli_query($connect, $sql);

      $sql = "SELECT * FROM `023_customers` WHERE customerId=$customerId;";
      $result = mysqli_query($connect, $sql);
      $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
      $_SESSION['user'] = $user[0];

      mysqli_close($connect);
    }

    if (isset($_POST['updateProfileImage'])){
        $_SESSION['user']['formAction'] =  true;

        $customerId = $_SESSION['user']['customerId'];
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/student023/shop/assets/images/customers/".(string) $customerId;
        $target_file = $target_dir .'/'. basename($_FILES["customerProfileImage"]["name"]);
        $isSuccessful = true;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // CHECK IF EXISTS THE DIRECTORY
        if (!is_dir($target_dir)){
            // CREATE DIRECTORY IF NOT EXISTS
            mkdir($target_dir, 0777, true);
        }

        // DELETE PREVIOUS FILES TO PREVENTO MORE THAN ONE IMAGE    
        $resultScan = scandir($target_dir);
        foreach($resultScan as $entity){
            if(!is_dir($entity)){
                unlink($target_dir.'/'.$entity);
            }
        }

        if ($_FILES["customerProfileImage"]["size"] > 50000000) {
            $isSuccessful = false;
        } 

        // CHECK EXTENSION FORMAT OF THE FILE
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $isSuccessful = false;
        }        

        //CHECK IF THE IMAGE EXISTS
        if (file_exists($target_file)) {
            $isSuccessful = false;
        } 

        // Check if isSuccessful
        if ($isSuccessful) {
            if (!move_uploaded_file($_FILES["customerProfileImage"]["tmp_name"], $target_file)) {
                
                $imagePath = "/student023/shop/assets/images/customers/default.png";
                include($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php');
                $sql = "UPDATE 023_customers
                        SET imagePath = '$imagePath'
                        WHERE customerId = $customerId;";

                //INERT PRODUCT
                mysqli_query($connect, $sql);

                //CLOSE DB CONEXION
                mysqli_close($connect);  
                return;
            } 

            $imagePath = "/student023/shop/assets/images/customers/".(string)$customerId.'/' .basename($_FILES["customerProfileImage"]["name"]);
            include($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php');
            $sql = "UPDATE 023_customers
                    SET imagePath = '$imagePath'
                    WHERE customerId = $customerId;";

            //INERT PRODUCT
            mysqli_query($connect, $sql);

            //CLOSE DB CONEXION
            mysqli_close($connect);  
        }   
    }
?>