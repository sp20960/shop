<?php 

if(isset($_POST['submit'])){
  $review = $_POST['review'];
  $mark = $_POST['mark'];
  $subject = $_POST['subject'];
  $customerId = $_SESSION['user']['customerId'];
  $productId = $_POST['productId'];

  $sql = "INSERT INTO 023_reviews(`customerId`, `productId`, `subject`, `content`, `mark`)
          VALUES($customerId, $productId, '$subject', '$review' ,$mark);";

  require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php';
  
  mysqli_query($connect, $sql);
}

?>