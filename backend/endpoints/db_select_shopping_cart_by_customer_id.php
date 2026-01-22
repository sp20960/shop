<?php 
session_start();

if(isset($_SESSION['user'])){
  $customerId = $_SESSION['user']['customerId'];

  $sql = "SELECT productId, quantity
          FROM `023_shopping_carts`
          WHERE customerId = $customerId;";
  
  require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/config/db_connect.php');

  $result = mysqli_query($connect, $sql);
  mysqli_close($connect);
  
  $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

  require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/products_functions.php');

  foreach($products as $product):

  $productId = $product['productId'];
  $quantity = $product['quantity'];

  $productData = returnProductById($productId);

  echo '
    <div class="shopping-cart-product" data-product-id="'.$productId.'", data-product-price="'.$productData[0]['pricePerUnit'].'">
                    <div>
                        <img src="'.$productData[0]['imagePath'].'" alt="" width="100">
                    </div>
                    <div class="shopping-cart-product__info">
                        <div>
                            <h3>'.$productData[0]['productName'].'</h3>
                            <small>En stock</small>
                        </div>
                        <div>
                            <i class="fa-solid fa-trash fa-xl"></i>
                            <div>
                                <select id="quantity">
                                    <option value="1" '.($quantity == 1 ? "selected": "").'>1</option>
                                    <option value="2" '.($quantity == 2 ? "selected": "").'>2</option>
                                    <option value="3" '.($quantity == 3 ? "selected": "").'>3</option>
                                    <option value="4" '.($quantity == 4 ? "selected": "").'>4</option>
                                    <option value="5" '.($quantity == 5 ? "selected": "").'>5</option>
                                    <option value="6" '.($quantity == 6 ? "selected": "").'>6</option>
                                    <option value="7" '.($quantity == 6 ? "selected": "").'>7</option>
                                    <option value="8" '.($quantity == 8 ? "selected": "").'>8</option>
                                    <option value="9" '.($quantity == 9 ? "selected": "").'>9</option>
                                    <option value="10" '.($quantity == 10 ? "selected": "").'>10</option>
                                </select>
                                <h2>'.$productData[0]['pricePerUnit'].'€</h2>
                            </div>
                        </div>
                    </div>
                </div>
    
    ';
  endforeach;
}
?>