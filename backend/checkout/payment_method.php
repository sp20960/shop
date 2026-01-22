<?php 
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/guest_header.php'); 
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/db/payment_methods/db_select_payment_methods.php'); 

?>

<main class="flex flex-col items-center">
    <section class="flex justify-center pt-20 gap-5 w-1/2">
        <div class="border border-primary h-13 rounded-full px-2 bg-accent">
            <i class="fa-solid fa-lock fa-2xl mt-6"></i>
        </div>
        <hr class="w-70 mt-6">
        <div class="border border-primary h-13 rounded-full px-2 bg-accent">
            <i class="fa-solid fa-location-dot fa-2xl mt-6"></i>
        </div>
        <hr class="w-70 mt-6">
        <div class="border border-primary h-13 rounded-full px-2 bg-accent">
            <i class="fa-solid fa-truck fa-2xl mt-6"></i>
        </div>
        <hr class="w-70 mt-6">
        <div class="border border-primary h-13 rounded-full px-2 bg-accent">
            <i class="fa-solid fa-credit-card fa-2xl mt-6"></i>
        </div>
        <hr class="w-70 mt-6">
        <div class="border border-primary h-13 rounded-full px-2">
            <i class="fa-solid fa-clipboard-list fa-2xl mt-6"></i>
        </div>
    </section>

    <section class="mt-10 w-1/2">
        <h2 class="font-latobold text-4xl">¿Como quiere pagar?</h2>

        <div class="pt-10">

            <div class="flex items-center cursor-pointer">
              <h3 class="font-latobold text-2xl">Selecciona el método de pago</h3>
            </div>

            <hr class="my-10">

            <form action="./tpv.php" id="payment-form" method="POST" class="flex flex-col pt-5 gap-10">
              <?php
                foreach($paymentMethods as $paymentMethod):
              ?>
                <div class="flex gap-5 border border-primary rounded-xl p-10 shadow-2xl">
                  <input type="radio" name="paymentMethod" id="<?= $paymentMethod['name'] ?>" value="<?= $paymentMethod['paymentId'] ?>" required>
                  <label for="<?= $paymentMethod['name'] ?>" class="text-xl font-bold"><?= $paymentMethod['name'] ?></label>
                </div>
              <?php
                endforeach;
              ?>
            </form>
            
            <hr class="my-15">
        </div>

        <div class="flex justify-center mb-10">
          <button name="submit" class="bg-accent flex items-center gap-5 px-15 py-5 rounded-4xl cursor-pointer text-2xl font-bold font-latobold" form="payment-form">Continuar<i class="fa-regular fa-arrow-right pt-1.5"></i></button>
        </div>

    </section>
    
</main>
</body>
</html>