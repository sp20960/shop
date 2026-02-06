<?php
session_start();

if($_SESSION['user']['rol'] === "admin") {

  $sql="SELECT *
        FROM `023_total_income_per_vendor`;";

  require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php';

  $incomePerVendors = mysqli_fetch_all(mysqli_query($connect, $sql), MYSQLI_ASSOC);

  $data = ["labels" => [], "data" => []]; 

  foreach($incomePerVendors as $incomePerVendor) {
    array_push($data['labels'], $incomePerVendor['vendorName']);
    array_push($data['data'], $incomePerVendor['total']);
  }
  echo json_encode($data);
}
?>