<?php
    if (isset($_POST['insert']))  {
       
        //GET DATA
        $productName = $_POST["productName"];
        $description = $_POST["description"];
        $brand = $_POST["brand"];
        $cost = $_POST["cost"];
        $pricePerUnit = $_POST["pricePerUnit"];
        $frets = $_POST["frets"];
        $color = $_POST["color"];
        $bodyMaterial = $_POST["bodyMaterial"];
        $tremolo = $_POST["tremolo"];
        $categoryId = $_POST["categoryId"];

        //FILE CHECKS AND TREATMENT
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/student023/shop/assets/images/products/".strtolower(str_replace(" ", "_", $productName));
        $target_file = $target_dir .'/'. basename($_FILES["productImage"]["name"]);
        $isSuccessful = true;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // CHECK IF EXISTS THE DIRECTORY
        if (!is_dir($target_dir)){
            // CREATE DIRECTORY IF NOT EXISTS
            mkdir($target_dir, 0777, true);
        }

        // CHECK FILE SIZE
        if ($_FILES["productImage"]["size"] > 50000000) {
            $message= "El fichero supera los 500MB!";
            $isSuccessful = false;
        } 

        // CHECK EXTENSION FORMAT OF THE FILE
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $message = "Solo JPG, JPEG y PNG estan permitidos!.";
            $isSuccessful = false;
        }        

        //CHECK IF THE IMAGE EXISTS
        if (file_exists($target_file)) {
            $message = "El fichero ya existe!";
            $isSuccessful = false;
        } 

        // Check if isSuccessful
        if ($isSuccessful) {
            if (!move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
                $message = "Ha habido un problema subiendo la imagen!";
            } 

            $imagePath = "/student023/shop/assets/images/products/".strtolower(str_replace(" ", "_", $productName)).'/' .basename($_FILES["productImage"]["name"]);
            include($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php');
            $sql = "INSERT INTO 023_products (productName, `description`, cost, pricePerUnit, brand, frets, color, bodyMaterial, tremolo, categoryId, imagePath)
            VALUES ('$productName', '$description', $cost, $pricePerUnit, '$brand', $frets, '$color', '$bodyMaterial', $tremolo, $categoryId, '$imagePath' )";

            //INERT PRODUCT
            if(mysqli_query($connect, $sql))
            {
              mysqli_close($connect);   
              header("Location: http://".$_SERVER['SERVER_NAME'].'/student023/shop/backend/admin/products.php?proc=successfull&msg=Producto+añadido+correctamente');
            } else{
              mysqli_close($connect);   
              header("Location: http://".$_SERVER['SERVER_NAME'].'/student023/shop/backend/admin/products.php?proc=fail&msg=¡Ha+habido+un+problema!');
            }

        }else {
          header("Location: http://".$_SERVER['SERVER_NAME'].'/student023/shop/backend/admin/products.php?proc=fail&msg=' + $message);
        }     
    }
?>
