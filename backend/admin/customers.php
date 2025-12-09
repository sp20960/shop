<?php 
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/admin_header.php';
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/security/protect_admin_pages.php');
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/db/customers/db_select_customers.php';
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/customers_functions.php';

?>

<main class="flex flex-col px-10 py-10 gap-5 font-latobold bg-secondary w-screen">
  <div>
    <small class="text-lg ">Last 20 customers</small>
  </div>
  <div>
    <form id="search-customer" class="relative">
      <input type="search" placeholder="customer email..." id="input-user-filter" class="rounded-lg shadow px-2 py-2 bcustomer bg-white bcustomer-accent w-100">
      <button type="submit"><i class="fa-solid fa-search absolute top-3.5 transform left-94"></i></button>

    </form>
  </div>
  <div class="flex flex-wrap gap-10 justify-start" id="list-customers">
    <?php 
    foreach($customers as $customer):
      showCustomer($customer);
    endforeach
    ?>
  </div>
  <script src="/student023/shop/js/backend_customers.js"></script>
</main>
<?php require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/footer.php'?>