<?php 
require __DIR__. '../../../vendor/autoload.php';

use UUID\UUID;

$uuid7_first = UUID::uuid7();

echo $uuid7_first;
?>