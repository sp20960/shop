<?php 
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/admin_header.php';
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/customers_functions.php';
require($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/db/reviews/db_review_insert.php');

?>
<main class="w-screen bg-secondary flex flex-col py-10 px-10 gap-20">
  <div>
      <h1 class="font-latobold text-3xl pb-10">Reviews Pendientes</h1>
      <div class="flex flex-wrap gap-5">
        <?php 
          $productsReviews = availableReviews($_SESSION['user']['customerId']);

          if(isset($productsReviews[0]['productName'])):
            foreach($productsReviews as $productReview):
              echo '
                <div class="bg-primary w-180 text-text p-10 flex flex-col gap-5 rounded-2xl hover:scale-101 transition-all">
                  <div class="flex">
                    <h2 class="font-latobold text-2xl">' . $productReview['productName'] . '</h2>
                  </div>
                  <div class="flex flex-col">
                    <h3 class="font-latoregular">Fecha de compra: ' . $productReview['insertedOn'] . '</h3>
                    <div class="flex pt-8">
                        <i class="fa-regular fa-star fa-2xl star"></i>
                        <i class="fa-regular fa-star fa-2xl star"></i>
                        <i class="fa-regular fa-star fa-2xl star"></i>
                        <i class="fa-regular fa-star fa-2xl star"></i>
                        <i class="fa-regular fa-star fa-2xl star"></i>
                    </div> 
                  </div>
                  <form action="/student023/shop/backend/customer/my_reviews.php" method="POST" class="flex flex-col gap-5">
                    <input type="hidden" name="productId" value="' . $productReview['productId'] . '" />
                    <input type="hidden" name="mark" id="mark" value="0" />
                    <input type="text" name="subject" placeholder="Asunto...*" class="bg-white rounded-md p-2 text-black" required/>
                    <textarea name="review" cols="50" rows="5" class="bg-white rounded-md text-black p-2" placeholder="Opinión...*" required></textarea>
                    <div class="pt-5">
                      <button type="submit" name="submit" class="bg-accent font-latobold px-7 py-2 rounded-md cursor-pointer">Enviar</button>
                    </div>
                  </form>
                </div>
          
                ';
            endforeach;
          else:
            echo '<h1 class="font-latobold text-6xl">No hay opiniones disponibles :(</h1>';
          endif;
        ?>
      </div>
  </div>
  <div>
      <h1 class="font-latobold text-3xl pb-10">Reviews Realizadas</h1>
    <div class="flex flex-wrap gap-5">
    <?php 
      $completedReviews = completedReviews($_SESSION['user']['customerId']);
      if(isset($completedReviews[0]['productName'])):
        foreach ($completedReviews as $completedReview): 
          echo '
                <div class="flex flex-col bg-primary text-text rounded p-5 w-180">
                          <div class="flex gap-2">
                              <div class="flex items-center">
                                <img class="object-cover" src="/student023/shop/assets/images/customers/default.png" alt="" width="50" height="50">

                              </div>
                              <div>
                                  <div>
                                    <h3>'.$completedReview['productName'].'</h3>
                                  </div>
                                  <div class="flex items-center gap-2">
                                    <h3 class="text-lg font-latobold">' . $completedReview['subject'] . '</h3>';
                                  if ($completedReview['isChecked'] == 0):
                                    echo ' <i class="fa-regular fa-clock text-orange-400! relative" id="check-review">
                                      <div id="info-check-review" class=" hidden absolute bg-secondary text-black w-50 p-2 rounded border border-accent bottom-2 left-5">
                                        <p class="font-latoregular">Esta review esta siendo revisada por nuestro equipo.</p>
                                      </div>
                                    </i>';
                                  endif;
                          echo '</div>
                                  <div>';
                                  if($completedReview['mark'] != 0):
                                    for($i = 1; $i <= $completedReview['mark']; $i++):
                                        echo '<i class="fa-solid fa-star"></i>';
                                    endfor;  
                                  endif;
                                  if($completedReview['mark'] != 5):
                                    $emptyStars = 5 - $completedReview['mark'];
                                    for($i = 1; $i <= $emptyStars; $i++):
                                      echo '<i class="fa-regular fa-star"></i>';
                                    endfor;
                                  endif;
                            echo' </div>
                              </div>
                          </div>
                          <p>' . $completedReview['content'] . '</p>
                      </div>';
          endforeach;
        else:
          echo '<h1 class="font-latobold text-6xl">No hay opiniones registradas :(</h1>';
        endif;  
    ?>
    </div>
  </div>
  <script src="/student023/shop/js/my_reviews.js"></script>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/footer.php'); ?>