<?php 
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/guest_header.php'); 
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/customers_functions.php'); 
$customerId = $_SESSION['user']['customerId'];
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
        <div class="border border-primary h-13 rounded-full px-2">
            <i class="fa-solid fa-truck fa-2xl mt-6"></i>
        </div>
        <hr class="w-70 mt-6">
        <div class="border border-primary h-13 rounded-full px-2">
            <i class="fa-solid fa-credit-card fa-2xl mt-6"></i>
        </div>
        <hr class="w-70 mt-6">
        <div class="border border-primary h-13 rounded-full px-2">
            <i class="fa-solid fa-clipboard-list fa-2xl mt-6"></i>
        </div>
    </section>
 
   
    <div class="mt-10 w-1/2">
      <h2 class="font-latobold text-4xl">¿Cual es tu dirección?</h2>
    </div>

    <section class="w-1/2 mt-10">
      <form action="./shipping_method.php" method="POST" id="address-form">
        <?php 
          foreach(returnAddressesCustomer($customerId) as $address):
        ?>
          <div class="border border-primary rounded-2xl flex p-5 gap-10 shadow-2xl">
            <input type="radio" name="address" value="<?= $address['addressId'] ?>" required>
            <div class="flex flex-col text-lg font-latoregular">
              <p><?= $address['address'] ?></p>
              <p><?= $address['additionalData'] ?></p>
              <p><?= $address['zipCode'] ?></p>
              <p><?= $address['province'] ?></p>
              <p><?= $address['city'] ?></p>
            </div>
          </div>
        <?php endforeach; ?>

      </form>
   
    </section>

    <section class="w-1/2">
        <div class="pt-10">

            <div class="flex items-center cursor-pointer">
              <h3 class="font-latobold text-2xl">Añadir una dirección</h3>
              <i class="fa-solid fa-caret-down"></i>
            </div>
            
            <form action="../db/customers/db_address_insert.php" class="flex-col pt-5 gap-10 hidden">
                <input type="text" name="nif" placeholder="Empresa/Institución/NIF/DNI OPCIONAL" class="p-5 shadow-xl text-xl rounded"/>
                <div class="flex gap-5">
                    <input type="text" name="firstName" placeholder="Nombre" class="p-5 shadow-xl text-xl w-1/2 rounded-lg" required />
                    <input type="text" name="lastName" placeholder="Apellidos" class="p-5 shadow-xl text-xl w-1/2 rounded-lg" required />
                </div>
                <input type="text" name="address" placeholder="Nombre y número de la calle" class="p-5 shadow-xl text-xl rounded-lg" required>
                <div class="flex gap-5">
                    <input type="text" name="zipCode" placeholder="Código postal" class="p-5 shadow-xl text-xl w-1/2 rounded-lg" required />
                    <input type="text" name="province" placeholder="Localidad" class="p-5 shadow-xl text-xl w-1/2 rounded-lg" required />
                </div>  
                <div class="flex justify-center mb-10">
                  <button name="submit" class="bg-accent flex items-center gap-5 px-15 py-5 rounded-2xl cursor-pointer text-xl font-bold font-latobold" form="payment-form">Guardar</button>
                </div>
            </form>
        </div>
    </section>

    <div class="flex justify-center mt-10">
          <button name="submit" form="address-form" class="bg-accent flex items-center gap-5 px-15 py-5 rounded-4xl cursor-pointer text-2xl font-bold font-latobold" form="payment-form">Continuar<i class="fa-regular fa-arrow-right pt-1.5"></i></button>
    </div>

</main>
</body>
</html>