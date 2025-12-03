<?php
function returnCustomerData($customerId){
  $sql = "SELECT * FROM 023_customers 
                WHERE customerId = $customerId;";
  require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/config/db_connect.php');
  $result = mysqli_query($connect, $sql);
  $userData = mysqli_fetch_all($result, MYSQLI_ASSOC);
  mysqli_close($connect);
  return $userData;
}

function returnAddressesCustomer($customerId){
  $sql = "SELECT ad.*, ca.* 
                FROM `023_addresses` AS ad
                INNER JOIN `023_customers_addresses` AS ca
                ON ad.addressId = ca.addressId
                WHERE ca.customerId = $customerId";;

  require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/config/db_connect.php');
  $result = mysqli_query($connect, $sql);
  mysqli_close($connect);
  $addresses = mysqli_fetch_all($result, MYSQLI_ASSOC);
  return $addresses;
}

function OrdersCustomer($customerId){
  $sql = "SELECT *
              FROM `023_orders_view`
              WHERE customerId = $customerId;";
  require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/config/db_connect.php');
  $result = mysqli_query($connect, $sql);
  $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
  foreach ($orders as $order):
    echo '<div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm mb-4 h-60 flex flex-col w-60">
    
              <div class="flex justify-between items-center mb-2">
                  <span class="text-lg font-bold">#' . $order['orderNumber'] . '</span>
                  <span class="px-3 py-1 rounded-full text-white text-sm bg-accent">
                      ' . strtoupper($order['status']) . '
                  </span>
              </div>

              <div class="text-gray-700 space-y-1">
                  <p><span class="font-semibold">Cliente:</span> ' . strtoupper($order['firstName']) . '</p>
                  <p><span class="font-semibold">Total:</span> ' . $order['subtotal'] . '</p>
                  <p><span class="font-semibold">Fecha:</span> ' . $order['insertedOn'] . '</p>
              </div>

              <div class="flex gap-2 mt-4">
                  <button class="px-4 py-2 rounded-lg bg-gray-600 text-white hover:bg-gray-700 transition">
                      Ver
                  </button>
              </div>

          </div>';
  endforeach;
}

function checkEmailExist($email){
  $sql = "SELECT email 
              FROM `023_customers`
              WHERE email = '$email';";

  require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/config/db_connect.php');

  $query = mysqli_query($connect, $sql);
  mysqli_close($connect);
  $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

  if (isset($result[0]['email'])) {
    return true;
  }

  return false;
}

function availableReviews($customerId){
  $sql = "SELECT *
              FROM `023_orders_view`
              WHERE customerId = $customerId
              AND productId NOT IN(SELECT productId 
                                  FROM 023_reviews)
              AND status = 'completed'";
  require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/config/db_connect.php');
  $result = mysqli_query($connect, $sql);
  mysqli_close($connect);
  return $productsReviews = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function completedReviews($customerId)
{
  $sql = "SELECT r.*, p.*
              FROM `023_reviews` AS r
              INNER JOIN `023_products` AS p
              ON r.productId = p.productId
              WHERE customerId = $customerId;";

  require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/config/db_connect.php');
  $result = mysqli_query($connect, $sql);
  mysqli_close($connect);
  return $completedReviews = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
