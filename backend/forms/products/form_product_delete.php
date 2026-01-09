<?php 
    require($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/admin_header.php');
    $productId = $_POST["productId"];
?>
<main>
    <div class="flex justify-center items-center h-full p-10 bg-secondary w-[calc(100vw-280px)]">
        <div class="bg-primary w-100 flex flex-col gap-8 p-10 rounded-2xl">
            <h1 class="text-text text-center">Estas seguro que quieres eliminar este product_id <?= htmlspecialchars($productId);?></h1>
            <div class="flex justify-center gap-40">
                <button class="bg-btn text-text rounded-sm w-20 p-1 cursor-pointer" onclick="location.href='../../admin/products.php'">Atras</button>
                <form action="/student023/shop/backend/db/products/db_product_delete.php" method="POST" class="">
                    <input type="text" name="productId" value="<?= htmlspecialchars($productId); ?>" hidden>
                    <input type="submit" value="Aceptar"  name="delete" class="text-text bg-btn w-20 p-1 rounded-sm cursor-pointer">
                </form>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/footer.php');?>
