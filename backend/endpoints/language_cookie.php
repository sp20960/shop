<?php 
if(isset($_GET['language'])):
  $language = $_GET['language'];
  setcookie('language', $language, time() + (86400 * 1), '/');
endif;
?>