<?php 

require_once __DIR__.'/../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/../../');
$dotenv->load();

$host = $_ENV['MAIL_HOST'];
$port = $_ENV['MAIL_PORT'];
$username = $_ENV['MAIL_USERNAME'];
$password = $_ENV['MAIL_PASSWORD'];

return ['host' => $host, 'port' => $port, 'username' => $username, 'password' => $password];
?>