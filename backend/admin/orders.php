<?php 
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/admin_header.php';
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/security/protect_admin_pages.php');
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/db/orders/db_select_orders.php';
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/orders_functions.php';
?>

<main class="flex flex-col px-10 py-10 gap-5 font-latobold bg-secondary w-screen">
  <div>
    <small class="text-lg ">Last 20 orders</small>
  </div>
  <div>
    <form id="search-order" class="relative">
      <input type="search" placeholder="Order number..." id="input-user-filter" class="rounded-lg shadow px-2 py-2 border bg-white border-accent w-100">
      <button type="submit"><i class="fa-solid fa-search absolute top-3.5 transform left-94"></i></button>

    </form>
  </div>
  <div class="flex flex-wrap gap-10 justify-start" id="list-orders">
    <?php 
    foreach($orders as $order):
      showOrder($order);
    endforeach
    ?>
  </div>
  <script src="/student023/shop/js/backend_orders.js"></script>
</main>
<?php require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/footer.php'?>