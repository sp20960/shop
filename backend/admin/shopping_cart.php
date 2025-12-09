<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/admin_header.php');
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/security/protect_admin_pages.php');
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/db/shopping_cart/db_shopping_cart_select.php');
?>

<main class="flex gap-5 bg-secondary p-10 w-full">
    <div class="w-full flex flex-row gap-5">
        <div class="flex flex-col justify-center gap-5 w-[50%]">
        <?php
        $totalPrice = 0;
        foreach ($products as $product) {
            $totalPrice += $product['pricePerUnit'] * $product['quantity'];
            echo '<div class="flex border-2 justify-between items-center border-accent rounded-md bg-primary p-4">' .
                    '<div class="flex items-center gap-2">' .
                        '<img class="w-[80px]" src="' . $product['imagePath'] . '" ' . 'alt="">' .
                        '<div class="flex flex-col">' .
                            '<h3 class="text-text">' . $product['productName'] . '</h3>' .
                            '<p class="text-text">' . $product['pricePerUnit'] . '€' . '</p>' .
                         '</div>' .
                    '</div>' .
                    '<div class="flex items-center gap-5">';
                        echo '<div data-product="'.$product['productId'].'" class="flex items-center gap-2">'.
                                '<i id="minus-icon" class="fa-solid fa-minus text-text cursor-pointer"></i>'.
                                '<p id="quantity" class="text-text">'.$product['quantity'].'</p>'.
                                '<i id="plus-icon" class="fa-solid fa-plus text-text cursor-pointer"></i>'.
                              '</div>';
                        require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/forms/shopping_cart/form_shopping_cart_delete_call.php');
           echo    '</div>' .
                '</div>';
        }
        ?>
        </div>
        <div class="flex justify-center items-center w-[50%]">
            <div class="bg-primary w-[50%] flex flex-col justify-center items-center py-10 gap-5 rounded-xl">
                <div class="">
                    <h3 class="text-text text-2xl font-bold text-center">Total: <span id="total-price"><?= htmlspecialchars($totalPrice)?></span>€</h3>
                    <p class="text-text">Todos los precios incluyen <span class="font-bold">IVA</span></p>
                </div>
                <div>
                    <button class="bg-btn rounded-md py-3 px-10 font-bold text-text cursor-pointer">IR A CAJA<i class="fa-solid fa-arrow-right"></i></button> 
                </div>
            </div>
        </div>
    </div>
<script src="/student023/shop/js/backend_shopping_cart.js"></script>
</main>


<?php require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/footer.php'); ?>