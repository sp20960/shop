<?php 
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/admin_header.php';
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/customers_functions.php';
?>

<main class="flex flex-col px-10 py-10 gap-5 font-latobold w-screen bg-secondary">
  <div>
    <small class="text-lg ">Last orders</small>
  </div>
  <div class="flex flex-wrap gap-10 justify-start">
    <?php 
      OrdersCustomer($_SESSION['user']['customerId']);
    ?>
  </div>
  
</main>
<?php require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/footer.php'?>