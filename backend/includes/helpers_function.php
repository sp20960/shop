<?php 
function getWeatherInfo(){
  $sql = "SELECT jsonData
          FROM `023_weather_records`
          ORDER BY insertedOn DESC
          LIMIT 1;";
  
  require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php';

  $result = mysqli_query($connect, $sql);
  $data = mysqli_fetch_assoc($result);
  
  return json_decode($data['jsonData'], true);
}

?>