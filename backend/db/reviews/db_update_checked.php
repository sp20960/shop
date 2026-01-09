<?php 
if(isset($_POST['acceptReview'])){
  $reviewId = $_POST['reviewId'];

  $sql = "UPDATE `023_reviews`
          SET isChecked = 1
          WHERE reviewId = $reviewId;";
  require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php';
  if(mysqli_query($connect, $sql)):
    header("Location: https://".$_SERVER['SERVER_NAME'].'/student023/shop/backend/admin/reviews.php?result=successful');
  else:
    header("Location: https://".$_SERVER['SERVER_NAME'].'/student023/shop/backend/admin/reviews.php?result=fail');   
  endif;  
  mysqli_close($connect);
  exit;
}

if(isset($_POST['denyReview'])){
  $reviewId = $_POST['reviewId'];

  $sql = "DELETE FROM `023_reviews`
          WHERE reviewId = $reviewId;";
  require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php';
  mysqli_query($connect, $sql);
  if(mysqli_close($connect)):
      header("Location: https://".$_SERVER['SERVER_NAME'].'/student023/shop/backend/admin/reviews.php?result=successful');
  else:
        header("Location: https://".$_SERVER['SERVER_NAME'].'/student023/shop/backend/admin/reviews.php?result=fail');
  endif;
}

?>