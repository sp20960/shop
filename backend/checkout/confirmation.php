<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/admin_header.php');

require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/db/shopping_cart/db_shopping_cart_select.php');

if(isset($_SESSION['user']['transactionId'])):

?>
<main class="w-screen">
  <section class="py-24 relative">
    <div class="w-full max-w-7xl px-4 md:px-5 lg:px-5 mx-auto">
      <div class="w-full flex-col justify-start items-center lg:gap-12 gap-8 inline-flex">
        <div class="w-full flex-col justify-start items-center gap-3 flex">
          <h2 class="text-center text-gray-900 text-3xl font-bold font-manrope leading-normal"><?= $_SESSION['user']['firstName'] ?>, Thank You for Your Order!</h2>
          <div class="justify-center items-center gap-2.5 inline-flex">
            <h5 class="text-gray-500 text-lg font-normal leading-8"> ID: <?= $_SESSION['user']['transactionId'] ?? 'XXXXXX'; ?> / Order Date: <?= Date('Y-m-d', time()) ?></h5>
          </div>
        </div>
        <div class="w-full flex-col justify-start items-center gap-8 flex">
         
            <div class="w-full lg:p-5 p-4 rounded-2xl border border-gray-200 flex-col justify-start items-start gap-5 flex">
              <div class="w-full px-5 pb-6 border-b border-gray-200 flex-col justify-start items-start gap-6 flex">
                <div class="w-full justify-between items-start gap-6 inline-flex">
                  <h5 class="text-gray-500 text-lg font-normal leading-8">Subtotal</h5>
                  <h5 class="text-right text-gray-900 text-lg font-semibold leading-8"><?= $_SESSION['user']['total'] ?? 00.00; ?></h5>
                </div>
                <div class="w-full justify-between items-start gap-6 inline-flex">
                  <h5 class="text-gray-500 text-lg font-normal leading-8">Shipping</h5>
                  <h5 class="text-right text-gray-900 text-lg font-semibold leading-8">$20.00</h5>
                </div>
              </div>
              <div class="px-5 pb-6 border-b border-gray-100 w-full justify-between items-start gap-6 inline-flex">
                <h5 class="text-black font-bold text-xl leading-8">Total</h5>
                <h5 class="text-right text-accent text-xl font-semibold leading-8"><?= $_SESSION['user']['total'] + 20 ?? 20.00; ?>€</h5>
              </div>
            </div>
          </div>
          <div class="w-full justify-end items-center gap-5 flex sm:flex-row flex-col">
            <button class="md:w-fit w-full px-5 py-2.5 bg-indigo-50 hover:bg-indigo-100 transition-all duration-700 ease-in-out rounded-xl justify-center items-center flex">
              <span class="px-2 py-px text-accent text-base cursor-pointer font-semibold leading-relaxed">View Order Details</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="../../js/backend_common.js"></script>
</main>
<?php 
  unset($_SESSION['user']['transactionid']);
endif
?>