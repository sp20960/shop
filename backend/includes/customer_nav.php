                <div class="flex flex-col gap-5 pt-10">
                    <div class="flex items-center justify-center cursor-pointer bg-btn p-2 rounded-md gap-1 hover:opacity-50 w-50" id="manage-products">
                        <i class="fa-regular fa-folder-open text-primary"></i>
                        <a href="/student023/shop/backend/customer/my_profile.php" class="text-text">My Profile</a>
                    </div>
                    <div class="flex items-center justify-center cursor-pointer bg-btn p-2 rounded-md gap-1 hover:opacity-50 w-50" id="add-client">
                        <i class="fa-solid fa-cart-shopping text-primary"></i>
                        <a href="/student023/shop/backend/customer/my_shopping_cart.php" class="text-text">My Shopping Cart</a>
                     </div>
                    <div class="flex items-center justify-center cursor-pointer bg-btn p-2 rounded-md gap-1 hover:opacity-50 w-50" id="add-product">
                        <i class="fa-regular fa-clipboard text-primary"></i>
                        <a href="/student023/shop/backend/customer/my_orders.php" class="text-text">My orders</a>
                    </div>
                    <div class="flex items-center justify-center cursor-pointer bg-btn p-2 rounded-md gap-1 hover:opacity-50 w-50" id="add-product">
                        <i class="fa-regular fa-star text-primary"></i>
                        <a href="/student023/shop/backend/customer/my_reviews.php" class="text-text">My reviews</a>
                    </div>
                    <div class="flex flex-col items-center gap-2">
                      <label for="idiomas" class="text-text font-latobold">Selecciona un idioma:</label>
                      <select id="languages" class="text-text bg-btn rounded-md px-5 py-2 border border-accent">
                        <option value="es" <?= (!isset($_COOKIE['language']) ? "" : $_COOKIE['language']=='es') ? 'selected' : '' ?>>🇪🇸 Español</option>
                        <option value="en" <?= (!isset($_COOKIE['language']) ? "" : $_COOKIE['language']=='en') ? 'selected' : '' ?>>🇺🇸 English</option>
                        <option value="fr" <?= (!isset($_COOKIE['language']) ? "" : $_COOKIE['language']=='fr') ? 'selected' : '' ?>>🇫🇷 Français</option>
                        <option value="de" <?= (!isset($_COOKIE['language']) ? "" : $_COOKIE['language']=='de') ? 'selected' : '' ?>>🇩🇪 Deutsch</option>
                      </select>
                    </div>
                </div>