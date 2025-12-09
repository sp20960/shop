<?php
$messages = ["update" => ["message" => "Actualizado correctamente", "type" => "success"], "delete" => ["message" => "Eliminado correctamente", "type" => "success"], 
                "insert" =>["message" => "Insertado correctamente", "type" => "success"] ,"cart" => ["message" => "Añadido al carrito correctamente", "type" => "success"] ];
$userAction;
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/admin_header.php');
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/security/protect_admin_pages.php');
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/db/products/db_product_insert.php');
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/db/products/db_product_update.php');
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/db/products/db_product_delete.php');
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/db/shopping_cart/db_shopping_cart_insert_update_content.php');
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/db/products/db_select_products.php');
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/products_functions.php');
?>


<main class="flex flex-col gap-5 bg-secondary p-10 w-full">
    <div class="absolute top-1 left-[50%] w-[calc(100vw-360px)]">
        <?php if($_SERVER['REQUEST_METHOD'] === "POST" && !empty($userAction)){ ?>
            <div class="bg-primary w-80 flex justify-center items-center py-5 rounded-md gap-2">
           
                <i class="fa-solid <?= $messages[$userAction]["type"] == "success" ? "fa-check text-green-600" : "fa-x text-red-600" ?>"></i>
                <p class="text-text font-bold"><?= $messages["$userAction"]["message"] ?></p>
           
            </div>
        <?php } ?>
    </div>
    <div class="flex justify-end">
        <button class="bg-btn text-text p-3 rounded-md cursor-pointer hover:opacity-90" id="add-product-btn">Add product</button>
    </div>
    <div>
        <form action="">
            <div class="relative">
                <input type="search" name="product-name" id="search-input" placeholder="Marca,nombre..." class="bg-white px-2 shadow border-2 border-accent rounded-md h-10 w-80 outline-none">
                <i class="fa-solid fa-search absolute left-72 top-4.5 fa-lg"></i>
            </div>
            
        </form>
    </div>
    <div id="filtered-products" class="flex flex-col gap-4"></div>
    <div class="flex flex-col gap-4" id="all-products">
    <?php
        foreach($products as $product) {
            showProduct($product);
        }
    ?>
    </div>
    <script src="/student023/shop/js/backend_products.js"></script>
</main>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/footer.php'); ?>
