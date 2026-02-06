<?php
session_start();

if($_SESSION['user']['rol'] === "admin" && isset($_GET['year'])) {
  $year = $_GET['year'];

  $sql="SELECT `month`, totalIncome
        FROM `023_total_income_per_month`
        WHERE `year` = '$year';";

  require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php';

  $salesPerMonth = mysqli_fetch_all(mysqli_query($connect, $sql), MYSQLI_ASSOC);

  $data = []; 
  $data = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0, 12 => 0];

  foreach($salesPerMonth as $salePerMonth) {
    $data[$salePerMonth['month']] = +$salePerMonth['totalIncome'];
  }
  echo json_encode($data);
}
?>