<?php
header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Content-Type: application/json; charset=utf-8");
if (isset($_POST['productId'])) {
  $productId = $_POST['productId'];
  $quantity = $_POST['quantity'];

  require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/products_functions.php');
  $product = returnProductById($productId);

  echo '
    <div class="shopping-cart-product" data-product-id="'.$productId.'", data-product-price="'.$product[0]['pricePerUnit'].'"
    data-quantity="'.$quantity.'" >
                    <div>
                        <img src="'.$product[0]['imagePath'].'" alt="" width="100">
                    </div>
                    <div class="shopping-cart-product__info">
                        <div>
                            <h3>'.$product[0]['productName'].'</h3>
                            <small>En stock</small>
                        </div>
                        <div>
                            <i class="fa-solid fa-trash fa-xl"></i>
                            <div>
                                <select class="quantity">
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
                                <h2>'.$product[0]['pricePerUnit'].'€</h2>
                            </div>
                        </div>
                    </div>
                </div>
    
    ';
}
