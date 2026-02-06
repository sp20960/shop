<?php
function showProduct($product)
{
?>
  <div class="flex border-2 justify-between items-center border-accent rounded-md bg-primary p-4">
    <div class="flex items-center gap-2">
      <p class="text-text"><?= $product['productId'] ?></p>
      <img class="w-[80px]" src="<?= $product['imagePath'] ?>" alt="">
      <div class="flex flex-col">
        <h3 class="text-text"><?= $product['productName'] ?></h3>
        <p class="text-text"><?= $product['pricePerUnit'] ?>€</p>
      </div>
    </div>
    <div class="flex gap-3">
      <?php
      include($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/forms/shopping_cart/form_shopping_cart_insert.php');
      include($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/forms/products/form_product_update_call.php');
      include($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/forms/products/form_product_delete_call.php');
      ?>
    </div>
  </div>
<?php
}

function showCategories($categoryId = '')
{
  $sql = 'SELECT * FROM `023_categories`;';

  require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/config/db_connect.php');
  $result = mysqli_query($connect, $sql);
  $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

  foreach ($categories as $category) {
    if ($category['categoryId'] != $categoryId) {
      echo '<option value="' . $category['categoryId'] . '">' . $category['categoryName'] . '</option>';
    } else {
      echo '<option value="' . $category['categoryId'] . '" selected>' . $category['categoryName'] . '</option>';
    }
  }
  mysqli_close($connect);
}

function returnProductById($productId = '')
{
  // START DB CONNECTION
  require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/config/db_connect.php');

  $sql = "SELECT * FROM `023_products` WHERE productId = $productId;";
  // FETCH DATA

  $result = mysqli_query($connect, $sql);
  mysqli_close($connect);

  return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function returnProducts()
{
  // START DB CONNECTION
  require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/config/db_connect.php');

  // FETCH DATA
  $sql = "SELECT * FROM `023_products`";

  $result = mysqli_query($connect, $sql);
  mysqli_close($connect);
  return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function insertProductVendor($product, $vendorId) {

require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php';
  
  $productCode = $product['product_id'];
  $productName = $product['product_name'];
  $description = $product['description'];
  $productUnitPrice = $product['product_price'];
  
  $productImage = 'https://remotehost.es'.$product['product_image'];

  $sql = "INSERT INTO `023_products`(`vendorId`, `productCode`, `productName`, `description`, `pricePerUnit`, `categoryId`, `imagePath`) 
          SELECT
          '$vendorId',
          '$productCode', 
          '$productName', 
          '$description', 
          $productUnitPrice, 
          categoryId, 
          '$productImage'
          FROM `023_categories`
          WHERE parentCategory = 'Vendor';";
  
  mysqli_query($connect, $sql);
  mysqli_close($connect);
}
?>