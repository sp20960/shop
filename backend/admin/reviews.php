<?php 
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/admin_header.php';
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/security/protect_admin_pages.php');
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/db/reviews/db_select_reviews_not_check.php';
?>
<main class="w-screen bg-secondary flex flex-col py-10 px-10 gap-50">
  <div>
      <h1 class="font-latobold text-3xl pb-10">Reviews a revisar</h1>

      <div class="flex flex-wrap gap-5">
              <?php 
      
        if(isset($reviews[0]['reviewId'])): 
          foreach($reviews as $review):
            echo '<div class="flex flex-col bg-primary text-text rounded p-5 w-180 font-latoregular">
                          <div class="flex gap-2">
                              <div class="w-full">
                                  <div class="flex gap-10 w-full pb-3 font-latobold text-xl">
                                    <h3>Review ID: '.$review['reviewId'].'</h3>
                                    <h3>Product ID: '.$review['productId'].'</h3>
                                    <h3>Customer ID: '.$review['customerId'].'</h3>
                                    <h3>Created at: '.$review['insertedOn'].'</h3>
                                  </div>
                                  <hr class="text-text pb-3">
                                  <div class="flex items-center gap-2">
                                    <h3 class="text-lg font-latobold">' . $review['subject'] . '</h3>';
                          echo '</div>
                                  <div>';
                                  if($review['mark'] != 0):
                                    for($i = 1; $i <= $review['mark']; $i++):
                                        echo '<i class="fa-solid fa-star"></i>';
                                    endfor;  
                                  endif;
                                  if($review['mark'] != 5):
                                    $emptyStars = 5 - $review['mark'];
                                    for($i = 1; $i <= $emptyStars; $i++):
                                      echo '<i class="fa-regular fa-star"></i>';
                                    endfor;
                                  endif;
                            echo' </div>
                              </div>
                          </div>
                          <p class="pb-3">' . $review['content'] . '</p>
                          <hr class="pb-3">
                          <div class="flex gap-5 justify-center py-5">
                            <form action="../db/reviews/db_update_checked.php" method="POST">
                              <input type="hidden" name="reviewId" value="'.$review['reviewId'].'" />
                              <button type="submit" name="acceptReview" class="cursor-pointer"><i class="fa-solid fa-check text-green-400! fa-2xl"></i></button>
                            </form>
                            <form action="reviews.php" method="POST">
                              <input type="hidden" name="reviewId" value="'.$review['reviewId'].'" />
                              <button type="submit" name="denyReview" class="cursor-pointer"><i class="fa-solid fa-x text-red-400! fa-2xl"></i></button>
                            </form>
                          </div>
                      </div>';
          endforeach;
        endif;
      ?>
      </div>
  </div>
  <div>
    <h1 class="font-latobold text-3xl pb-10">Historial de reviews</h1>
    <div class="flex flex-wrap gap-5">
      <?php 
      require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/db/reviews/db_select_reviews.php';
      if(isset($reviews[0]['reviewId'])): 
        foreach($reviews as $review):
         echo '<div class="flex flex-col bg-primary text-text rounded p-5 w-180 font-latoregular">
                          <div class="flex gap-2">
                              <div class="w-full">
                                  <div class="flex gap-10 w-full pb-3 font-latobold text-xl">
                                    <h3>Review ID: '.$review['reviewId'].'</h3>
                                    <h3>Product ID: '.$review['productId'].'</h3>
                                    <h3>Customer ID: '.$review['customerId'].'</h3>
                                    <h3>Created at: '.$review['insertedOn'].'</h3>
                                  </div>
                                  <hr class="text-text pb-3">
                                  <div class="flex items-center gap-2">
                                    <h3 class="text-lg font-latobold">' . $review['subject'] . '</h3>';
                          echo '</div>
                                  <div>';
                                  if($review['mark'] != 0):
                                    for($i = 1; $i <= $review['mark']; $i++):
                                        echo '<i class="fa-solid fa-star"></i>';
                                    endfor;  
                                  endif;
                                  if($review['mark'] != 5):
                                    $emptyStars = 5 - $review['mark'];
                                    for($i = 1; $i <= $emptyStars; $i++):
                                      echo '<i class="fa-regular fa-star"></i>';
                                    endfor;
                                  endif;
                            echo' </div>
                              </div>
                          </div>
                          <p class="pb-3">' . $review['content'] . '</p>
                      </div>';
      
        endforeach;
      endif;   
      ?>
    </div>
  </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/footer.php'); ?>