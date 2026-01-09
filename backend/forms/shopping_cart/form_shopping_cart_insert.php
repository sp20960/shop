<form action="/student023/shop/backend/db/shopping_cart/db_shopping_cart_insert_update_content.php" method="POST">
    <input type="hidden" name="productId" value="<?= htmlspecialchars($product['productId']) ?>">
    <button type="submit" name="submit"><i class="fa fa-cart-shopping text-text cursor-pointer"></i></button>
</form>