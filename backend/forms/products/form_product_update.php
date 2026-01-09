<?php 
    require($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/admin_header.php');
    require($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/products_functions.php');
    
    $productId = $_POST["productId"];
    $product = returnProductById($productId);
    // DECLARE VARIABLES TO SAVE PRODUCT INFO

    $productId = $product[0]["productId"];
    $productName = $product[0]["productName"];
    $description = $product[0]["description"];
    $cost = $product[0]["cost"];
    $pricePerUnit = $product[0]["pricePerUnit"];
    $brand = $product[0]["brand"];
    $frets = $product[0]["frets"];
    $color = $product[0]["color"];
    $bodyMaterial = $product[0]["bodyMaterial"];
    $tremolo = $product[0]["tremolo"];
    $categoryId = $product[0]["categoryId"];
?>
<main>
    <div class="flex justify-center p-10 bg-secondary w-[calc(100vw-280px)]">
        <form action="/student023/shop/backend/db/products/db_product_update.php" method="POST" class="flex flex-col gap-10 p-10 bg-primary w-300 rounded-xl">
            <input type="text" name="productId" value="<?= htmlspecialchars($productId); ?>" hidden>
            <div class="flex flex-col gap-2">
                <label for="productName" class="text-text">Nombre guitarra</label>
                <input type="text" name="productName" id="" placeholder="Nombre" class="text-text border p-2 rounded-md border-[#363636] bg-[#363636]" value="<?= htmlspecialchars($productName);?>">
            </div>
             <div class="flex flex-col gap-2">
                <label for="productName" class="text-text">Descripcion</label>
                <input type="text" name= "description" id="" placeholder="Descripción" class="text-text border p-2 rounded-md border-[#363636] bg-[#363636]" value="<?= htmlspecialchars($description);?>">
             </div>
             <div class="flex flex-col gap-2">
                <label for="brand" class="text-text">Marca</label>
                <input type="text" name= "brand" id="" placeholder="Marca" class="text-text border p-2 rounded-md border-[#363636] bg-[#363636]" value="<?= htmlspecialchars($brand);?>">
             </div>
            <div class="flex flex-col gap-2">
                <label for="cost" class="text-text">Precio Coste</label>
                <input type="number" name="cost" id="" placeholder="Precio Coste" class="text-text border p-2 rounded-md border-[#363636] bg-[#363636]" value="<?= htmlspecialchars($cost);?>">
            </div>
            <div class="flex flex-col gap-2">
                <label for="pricePerUnit" class="text-text">Precio por unidad</label>
                <input type="number" name="pricePerUnit" id="" placeholder="Precio Final" class="text-text border p-2 rounded-md border-[#363636] bg-[#363636]" value="<?= htmlspecialchars($pricePerUnit)?>">
            </div>
            <div class="flex flex-col gap-2">
                <label for="frets" class="text-text">Trastes</label>
                <input type="number" name="frets" id="" placeholder="Numero trastes" class="text-text border p-2 rounded-md border-[#363636] bg-[#363636]" value="<?= htmlspecialchars($frets) ?>">
            </div>
            <div class="flex flex-col gap-2">
                <label for="color" class="text-text">Color</label>
                <input type="text" name="color" id="" placeholder="Color" class="text-text border p-2 rounded-md border-[#363636] bg-[#363636]" value="<?= htmlspecialchars($color)?>">
            </div>
            <div class="flex flex-col gap-2">
                <label for="bodyMaterial" class="text-text">Material del cuerpo</label>
                <input type="text" name="bodyMaterial" placeholder="Material del cuerpo" class="text-text border p-2 rounded-md border-[#363636] bg-[#363636]" value="<?= htmlspecialchars($bodyMaterial)?>">
            </div>
            <div class="flex flex-col gap-2">
                <label for="tremolo" class="text-text">Tremolo</label>
                <select name="tremolo" id="tremolo" class="text-text border p-2 rounded-md border-[#363636] bg-[#363636]">
                    <option value="true" <?php echo ($tremolo == 1) ? "selected" : ""?>>Sí</option>
                    <option value="false" <?php echo ($tremolo == 0) ? "selected" : ""?>>No</option>
                </select>
            </div>
            <div class="flex flex-col gap-2">
                <label for="categoryId" class="text-text">Categoria</label>
                <select name="categoryId" id="tremolo" class="text-text border p-2 rounded-md border-[#363636] bg-[#363636]">
                    <?php 
                        showCategories($categoryId);
                    ?>
                </select>
            </div>
            <input type="submit" value="Actualizar" name="update" class="bg-btn text-text rounded-md cursor-pointer">
        </form>  
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/footer.php');?>