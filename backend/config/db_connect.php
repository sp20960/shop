<?php 
    require __DIR__. '/../../vendor/autoload.php';
    
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/../../');
    $dotenv->load();

    $host = $_ENV['DB_HOST'];
    $user = $_ENV['DB_USER'];
    $pwd = $_ENV['DB_PWD'];
    $database = $_ENV['DB_DATABASE'];

    $connect = mysqli_connect($host, $user, $pwd, $database);

    mysqli_set_charset($connect, "utf8");
?>