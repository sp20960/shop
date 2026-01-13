<?php 
  $info = file_get_contents('php://input');
  $date = date('Y-m-d_H-i-s', time());
  $file = $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/logs/weather_'.$date.'.json';
  $handle = fopen($file, 'a+');

  fwrite($handle, $info);
  fclose($handle);

  include($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php');

  $sql = "INSERT INTO `023_weather_records` (jsonData)
          VALUES ('$info');";

  mysqli_query($connect, $sql);
  mysqli_close($connect);

?>