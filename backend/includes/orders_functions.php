<?php 

function showOrder($order){
  echo '<div class="bg-primary/90 text-text border border-gray-200 rounded-xl p-4 shadow mb-4 min-h-60 flex flex-col w-110">
    
    <div class="flex flex-col-reverse items-start gap-2 mb-2">
        <span class="text-lg font-bold">#'.$order['orderNumber'].'</span>
        <span class="px-3 py-1 rounded-full text-white text-sm bg-accent">
            '.strtoupper($order['status']).'
        </span>
    </div>

    <div class="text-text space-y-1">
        <p><span class="font-semibold">Cliente:</span> '.strtoupper($order['firstName']).'</p>
        <p><span class="font-semibold">Total:</span> '.$order['subtotal'].'</p>
        <p><span class="font-semibold">Fecha:</span> '.$order['insertedOn'].'</p>
    </div>

    <div class="flex gap-2 mt-4">
        <button class="px-4 py-2 rounded-lg bg-gray-600 text-white hover:bg-gray-700 transition">
            Ver
        </button>
        <button class="px-4 py-2 rounded-lg bg-accent text-white hover:brightness-80 transition">
            Editar
        </button>
    </div>

</div>';

}

function apiOrderInsert($orderNumber) {
  
      $sql ="SELECT ord.quantity, ord.quantity * ord.productUnitPrice AS total_price, 
                    pr.productCode AS product_id, cu.firstName AS customerName, cu.phone AS customerPhone, 
                    cu.email AS customer_email, cu.lastName AS customerLastName, ve.*, 
                    ad.address AS street, ad.zipCode AS zipcode, ad.city, ad.country
             FROM `023_orders` AS ord
             INNER JOIN `023_products` AS pr
             ON ord.productId = pr.productId
             INNER JOIN `023_customers` AS cu
             ON ord.customerId = cu.customerId
             INNER JOIN `023_vendors` AS ve
             ON ord.vendorId = ve.vendorId
             INNER JOIN `023_customers_addresses` AS ca
             ON ord.customerId = ca.customerId
             INNER JOIN `023_addresses` AS ad
             ON ca.addressId = ad.addressId
             WHERE ord.orderNumber = '$orderNumber';";

  require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/config/db_connect.php';

  $orderProducts = mysqli_fetch_all(mysqli_query($connect, $sql), MYSQLI_ASSOC);

  foreach($orderProducts as $order):
    if ($order['vendorId'] != '44445384-fdf5-11f0-9f66-c2159bee87c9') {
      $apiKey = $order['apiKey'];
      $apiEndpointOrder = $order['api_endpoint_orders'];
      $orderJson = urlencode(json_encode($order));

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $apiEndpointOrder."?apiKey=$apiKey&orderContent=$orderJson");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      
      $response = curl_exec($ch);
    }
  endforeach;


}


?>

