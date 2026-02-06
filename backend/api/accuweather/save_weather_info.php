<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/student023/shop/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'].'/student023/shop');
$dotenv->load();

$apiKey = $_ENV['ACCUWEATHER_API_KEY'];
$locationKey = 1466169;

$curlHandle = curl_init();
$headers = ["Authorization: Bearer $apiKey", "Content-Type: application/json"];
curl_setopt($curlHandle, CURLOPT_URL, "https://dataservice.accuweather.com/currentconditions/v1/$locationKey");
curl_setopt($curlHandle, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);

$response_json = curl_exec($curlHandle);

if ($response_json) {

  $date = date('Y-m-d_H-i-s', time());
  $file = $_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/logs/weather_' . $date . '.json';
  $fileHandle = fopen($file, 'a+');
  fwrite($fileHandle, $response_json);
  fclose($fileHandle);
  
  include($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/config/db_connect.php');
  $sql = "INSERT INTO `023_weather_records` (jsonData)
          VALUES ('$response_json');";

  mysqli_query($connect, $sql);
  mysqli_close($connect);
}
