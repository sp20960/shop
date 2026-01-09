<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/admin_header.php');
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/security/protect_admin_pages.php');
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/db/products/db_select_products.php');
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/products_functions.php');
?>


<main class="flex flex-col gap-5 bg-secondary p-10 w-full">
    <div id="messages-container" class="absolute top-1 left-[50%] w-[calc(100vw-360px)] flex flex-col gap-2">
       
    </div>
    <div class="flex justify-end">
        <button class="bg-btn text-text p-3 rounded-md cursor-pointer hover:opacity-90" id="add-product-btn">Add product</button>
    </div>
    <div>
        <form action="" id="search-product">
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
