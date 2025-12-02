<?php 
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/admin_header.php';
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/db/orders/db_select_orders.php';
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/orders_functions.php';
?>

<main class="flex flex-col px-10 py-10 gap-5 font-latobold">
  <div>
    <small class="text-lg ">Last 20 orders</small>
  </div>
  <div class="flex flex-wrap gap-10 justify-start">
    <?php 
    foreach($orders as $order):
      showOrder($order);
    endforeach
    ?>
  </div>
  
</main>
<?php require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/footer.php'?>