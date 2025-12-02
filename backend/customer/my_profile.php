<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/admin_header.php');

    require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/db/customers/db_address_insert.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/db/customers/db_address_update.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/db/customers/db_customer_update.php');



require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/customers_functions.php');
$addresses = returnAddressesCustomer($_SESSION['user']['customerId']);
$userData = returnCustomerData($_SESSION['user']['customerId']);
?>

<main class="bg-secondary w-[calc(100vw-320px)] flex flex-col p-20 gap-5">
    <section class="flex w-full gap-5 justify-center">
        <section class="bg-primary/90 w-140 flex flex-col pt-5 py-10 gap-5 items-center shadow-2xl rounded-2xl hover:scale-101 transition-all">
            <h2 class="text-center text-text font-latobold text-2xl"><?= strtoupper($userData[0]['firstName'] . ' ' . $userData[0]['lastName']) ?></h2>
            <form action="my_profile.php" method="POST" class="flex flex-col items-center gap-5" enctype="multipart/form-data">
                <label for="input-profile-image">
                    <div class="rounded-full">
                        <img id="profile-image" src="<?= $userData[0]['imagePath'] ?>" width="300" alt="" class="cursor-pointer hover:opacity-40 transition-all rounded-full">
                    </div>
                </label>
                <input type="file" id="input-profile-image" name="customerProfileImage" class="hidden">
                <button class="bg-btn text-text font-latobold px-10 py-2 cursor-pointer hover:opacity-60 rounded-sm hidden" id="btn-save-profile-image" name="updateProfileImage" type="submit">Save</button>
            </form>
        </section>

        <section class="w-220 bg-primary/90 shadow-2xl rounded-2xl flex flex-col hover:scale-101 transition-all p-5">
            <h3 class="text-text text-2xl font-latobold">Account Details</h3>
            <form id="form-update-customer-info" action="my_profile.php" method="POST" class="flex gap-10 py-7 px-10">
                <div class="flex flex-col gap-5 w-80">
                    <div class="flex flex-col">
                        <label for="first-name" class="text-text font-latoregular">Name</label>
                        <input type="text" id="first-name" name="firstName" class="border-b-1 outline-none border-text text-text font-latoregular" value="<?= $userData[0]['firstName'] ?>">
                    </div>
                    <div class="flex flex-col">
                        <label for="nif" class="text-text font-latoregular">NIF</label>
                        <input type="text" name="nif" id="nif" class="border-b-1 outline-none border-text text-text font-latoregular" value="<?= $userData[0]['nif'] ?>">
                    </div>
                    <div class="flex flex-col">
                        <label for="phone" class="text-text font-latoregular">Phone</label>
                        <input type="text" id="phone" name="phone" class="border-b-1 outline-none border-text text-text font-latoregular" value="<?= $userData[0]['phone'] ?>">
                    </div>
                </div>
                <div class="flex flex-col gap-5 w-80">
                    <div class="flex flex-col">
                        <label for="last-name" class="text-text font-latoregular">Last Name</label>
                        <input type="text" id="last-name" name="lastName" class="border-b-1 outline-none border-text text-text font-latoregular" value="<?= $userData[0]['lastName'] ?>">
                    </div>
                    <div class="flex flex-col">
                        <label for="email" class="text-text font-latoregular">Email*</label>
                        <input type="email" id="email" name="email" class="border-b-1 outline-none border-text text-text font-latoregular" value="<?= $userData[0]['email'] ?>" required>
                    </div>
                </div>
            </form>
            <div class="flex justify-center pt-5">
                <button class="bg-btn text-text font-latobold px-10 py-2 cursor-pointer hover:opacity-60 rounded-sm" name="updateCustomer" type="submit" form="form-update-customer-info">Save</button>
            </div>
        </section>
    </section>
    
    <section class="flex gap-5">
        <section class="bg-primary/90 w-200 min-h-80 max-h-100 rounded-2xl shadow-2xl hover:scale-101 transition-all p-5 flex flex-col gap-5 overflow-y-scroll">
            <h2 class="text-text text-2xl font-latobold">Edit Addresses</h2>
            <?php if (isset($addresses[0]['addressId'])): ?>
                <?php for ($i = 0; $i < count($addresses); $i++): ?>
                    <div>
                        <div class="flex items-center" id="show-address-info">
                            <h1 class="text-text text-xl underline cursor-pointer">Address <?= $i ?></h1><i class="fa-regular fa-caret-down icon"></i>
                        </div>
                        <div class="pt-5 hidden">
                            <form action="my_profile.php" method="POST" class="flex flex-col gap-10">
                                <input type="hidden" name="addressId" value="<?= $addresses[$i]['addressId'] ?>">
                                <div class="flex gap-5">
                                    <input type="text" id="name" name="name" placeholder="Name*" class="pl-5 border-b-1 h-12 rounded outline-none bg-text font-latoregular w-[50%]" value="<?= $addresses[$i]['name'] ?>" required>
                                    <input type="test" id="lastName" name="lastName" placeholder="Last name*" class="pl-5 border-b-1 h-12 rounded outline-none bg-text font-latoregular w-[50%]" value="<?= $addresses[$i]['lastName'] ?>" required>
                                </div>
                                <div class="flex flex-col">
                                    <input type="text" id="address" name="address" placeholder="Address and number *" class="pl-5 border-b-1 h-12 rounded outline-none bg-text font-latoregular" value="<?= $addresses[$i]['address'] ?>" required>
                                </div>

                                <div class="flex flex-col">
                                    <input type="text" id="additional-data" name="additionalData" placeholder="Additional data" class="pl-5 border-b-1 h-12 rounded outline-none bg-text font-latoregular" value="<?= $addresses[$i]['additionalData'] ?>">
                                </div>

                                <div class="flex gap-5">
                                    <select name="province" class="bg-text rounded p-2">
                                        <option value="Andalucia">Andalucia</option>
                                        <option value="Aragon" <?= ($addresses[$i]['province'] == 'Aragon') ? 'selected' : '' ?>>Aragon</option>
                                        <option value="Asturias" <?= ($addresses[$i]['province'] == 'Asturias') ? 'selected' : '' ?>>Asturias</option>
                                        <option value="Baleares" <?= ($addresses[$i]['province'] == 'Baleares') ? 'selected' : '' ?>>Baleares</option>
                                        <option value="Ceuta" <?= ($addresses[$i]['province'] == 'Ceuta') ? 'selected' : '' ?>>Ceuta</option>
                                        <option value="Canarias" <?= ($addresses[$i]['province'] == 'Canarias') ? 'selected' : '' ?>>Canarias</option>
                                        <option value="Cantabria" <?= ($addresses[$i]['province'] == 'Cantabria') ? 'selected' : '' ?>>Cantabria</option>
                                        <option value="Castilla-La Mancha" <?= ($addresses[$i]['province'] == 'Castilla-La Mancha') ? 'selected' : '' ?>>Castilla-La Mancha</option>
                                        <option value="Castilla y Leon" <?= ($addresses[$i]['province'] == 'Castilla y Leon') ? 'selected' : '' ?>>Castilla y Leon</option>
                                        <option value="Cataluna" <?= ($addresses[$i]['province'] == 'Cataluna') ? 'selected' : '' ?>>Cataluna</option>
                                        <option value="Comunidad Valenciana" <?= ($addresses[$i]['province'] == 'Comunidad Valenciana') ? 'selected' : '' ?>>Comunidad Valenciana</option>
                                        <option value="Extremadura" <?= ($addresses[$i]['province'] == 'Extremadura') ? 'selected' : '' ?>>Extremadura</option>
                                        <option value="Galicia" <?= ($addresses[$i]['province'] == 'Galicia') ? 'selected' : '' ?>>Galicia</option>
                                        <option value="La Rioja" <?= ($addresses[$i]['province'] == 'La Rioja') ? 'selected' : '' ?>>La Rioja</option>
                                        <option value="Madrid" <?= ($addresses[$i]['province'] == 'Madrid') ? 'selected' : '' ?>>Madrid</option>
                                        <option value="Melilla" <?= ($addresses[$i]['province'] == 'Melilla') ? 'selected' : '' ?>>Melilla</option>
                                        <option value="Murcia" <?= ($addresses[$i]['province'] == 'Murcia') ? 'selected' : '' ?>>Murcia</option>
                                        <option value="Navarra" <?= ($addresses[$i]['province'] == 'Navarra') ? 'selected' : '' ?>>Navarra</option>
                                        <option value="Pais Vasco" <?= ($addresses[$i]['province'] == 'Pais Vasco') ? 'selected' : '' ?>>Pais Vasco</option>
                                    </select>
                                    <input type="text" id="city" name="city" placeholder="City*" class="pl-5 border-b-1 h-12 rounded outline-none bg-text font-latoregular w-50" value="<?= $addresses[$i]['city'] ?>" required>
                                    <input type="number" id="zip-code" name="zipCode" placeholder="ZIP code*" class="pl-5 border-b-1 h-12 rounded outline-none bg-text font-latoregular w-30" minlength="5" maxlength="5" value="<?= $addresses[$i]['zipCode'] ?>" required>
                                </div>
                                <div class="flex gap-2">
                                  <input type="checkbox" name="isDefault" id="is-default-address-<?= $addresses[$i]['addressId'] ?>" <?= ($addresses[$i]['isDefault'] == '1' ? "checked" : "") ?>>
                                  <label for="is-default-address-<?= $addresses[$i]['addressId'] ?>" class="font-latoregular text-text">Añadir esta dirección por defecto</label>
                                </div>
                                <div class="flex justify-center gap-5">
                                    <button name="deleteAddress" class="bg-red-600 text-text font-latobold px-10 py-2 cursor-pointer hover:opacity-60 rounded-sm" type="submit">Eliminar</button>
                                    <button name="updateAddress" class="bg-btn text-text font-latobold px-10 py-2 cursor-pointer hover:opacity-60 rounded-sm" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endfor ?>
            <?php endif ?>
            <div class="border border-black rounded bg-text w-50 p-2 hover:opacity-60">
                <button id="button-no-address" class="cursor-pointer"><i class="fa-regular fa-plus"></i>Add an address</button>
            </div>
        </section>
        <section class="bg-primary/90 w-160 min-h-80 max-h-80 rounded-2xl shadow-2xl hover:scale-101 transition-all p-5">
            <h2 class="text-text text-2xl font-latobold">Previous Orders</h2>
        </section>
    </section>

    <section id="container-add-address" class="absolute hidden w-150 bg-primary/99 top-50 right-100 z-30000 flex-col p-5 gap-10 rounded">
        <div class="flex justify-between items-center">
            <h3 class="text-text font-latobold text-xl">Add address</h3>
            <i id="close-add-address" class="fa-regular fa-x fa-xl text-text! cursor-pointer"></i>
        </div>

        <form action="my_profile.php" method="POST" class="flex flex-col gap-10">
            <div class="flex gap-5">
                <input type="text" id="name" name="name" placeholder="Name*" class="pl-5 border-b-1 h-12 rounded outline-none bg-text font-latoregular w-[50%]" required>
                <input type="test" id="lastName" name="lastName" placeholder="Last name*" class="pl-5 border-b-1 h-12 rounded outline-none bg-text font-latoregular w-[50%]" required>
            </div>
            <div class="flex flex-col">
                <input type="text" id="address" name="address" placeholder="Address and number *" class="pl-5 border-b-1 h-12 rounded outline-none bg-text font-latoregular" required>
            </div>

            <div class="flex flex-col">
                <input type="text" id="additional-data" name="additionalData" placeholder="Additional data" class="pl-5 border-b-1 h-12 rounded outline-none bg-text font-latoregular">
            </div>

            <div class="flex gap-5">
                <select name="province" class="bg-text rounded p-2">
                    <option value="Andalucia">Andalucia</option>
                    <option value="Aragon">Aragon</option>
                    <option value="Asturias">Asturias</option>
                    <option value="Baleares">Baleares</option>
                    <option value="Ceuta">Ceuta</option>
                    <option value="Canarias">Canarias</option>
                    <option value="Cantabria">Cantabria</option>
                    <option value="Castilla-La Mancha">Castilla-La Mancha</option>
                    <option value="Castilla y Leon">Castilla y Leon</option>
                    <option value="Cataluna">Cataluna</option>
                    <option value="Comunidad Valenciana">Comunidad Valenciana</option>
                    <option value="Extremadura">Extremadura</option>
                    <option value="Galicia">Galicia</option>
                    <option value="La Rioja">La Rioja</option>
                    <option value="Madrid">Madrid</option>
                    <option value="Melilla">Melilla</option>
                    <option value="Murcia">Murcia</option>
                    <option value="Navarra">Navarra</option>
                    <option value="Pais Vasco">Pais Vasco</option>
                </select>
                <input type="text" id="city" name="city" placeholder="City*" class="pl-5 border-b-1 h-12 rounded outline-none bg-text font-latoregular w-50" required>
                <input type="number" id="zip-code" name="zipCode" placeholder="ZIP code*" class="pl-5 border-b-1 h-12 rounded outline-none bg-text font-latoregular w-30" minlength="5" maxlength="5" required>
            </div>
            <div class="flex justify-center">
                <button name="addAddress" class="bg-btn text-text font-latobold px-10 py-2 cursor-pointer hover:opacity-60 rounded-sm" type="submit">Save</button>
            </div>
        </form>
    </section>

    <script src="/student023/shop/js/backend_my_profile.js"></script>
</main>


<?php require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/footer.php'); ?>