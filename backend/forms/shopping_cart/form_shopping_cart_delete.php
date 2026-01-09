<?php 
    $productId = $_POST["productId"];
?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/admin_header.php');?>
<main>
    <div class="flex justify-center items-center h-full p-10 bg-secondary w-[calc(100vw-280px)]">
        <div class="bg-primary w-100 flex flex-col gap-8 p-10 rounded-2xl">
            <h1 class="text-text text-center">Estas seguro que quieres eliminar este product_id <?php echo $productId?> de la cesta de la compra?</h1>
            <div class="flex justify-center gap-40">
                <button class="bg-btn text-text rounded-sm w-20 p-1 cursor-pointer" onclick="location.href='../../customer/my_shopping_cart.php'">Atras</button>
                <form action="/student023/shop/backend/db/shopping_cart/db_shopping_cart_delete.php" method="POST" class="">
                    <input type="text" name="productId" value="<?= htmlspecialchars($productId); ?>" hidden>
                    <input type="submit" name="submit" value="Aceptar" class="text-text bg-btn w-20 p-1 rounded-sm cursor-pointer">
                </form>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/footer.php');?>