<?php 
if(isset($_POST['language'])):
  $language = $_POST['language'];
  setcookie('language', $language, time() + (86400 * 1), '/');
endif;
?>