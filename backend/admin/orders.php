<?php 
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/admin_header.php';
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/security/protect_admin_pages.php');
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/db/orders/db_select_orders.php';
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/orders_functions.php';
?>

<main class="flex flex-col px-10 py-10 gap-5 font-latobold bg-secondary w-screen">
  <?php
    if(isset($_GET['o'])):
      $orderNumber = $_GET['o'];
      $orderInfo = returnOrderInfo($orderNumber);
  ?>
  <div class="fixed inset-0 bg-black/40 z-40"></div>

  <div class="fixed inset-0 z-50 flex items-center justify-center">
    <div class="bg-white w-full max-w-4xl max-h-[90vh] overflow-y-auto rounded-xl shadow-2xl p-6">

      <h2 class="text-2xl font-semibold text-center mb-6">
        Detalles de la Orden
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div>
          <label class="text-sm text-gray-600">Número de Orden</label>
          <input type="text" name="orderNumber" readonly value="<?= $orderInfo['orderNumber'] ?>"
            class="w-full mt-1 rounded-lg border-b py-2 px-2 border-gray-300 bg-gray-100 focus:ring-0 focus:border-gray-400">
        </div>

        <div>
          <label class="text-sm text-gray-600">Estado</label>
          <select name="status"
            class="w-full mt-1 rounded-lg border-b py-2 px-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            <option value="paid" <?= ($orderInfo['status'] == 'paid' ? 'selected' : '') ?>>Pagado</option>
            <option value="preparing" <?= ($orderInfo['status'] == 'preparing' ? 'selected' : '') ?>>Preparando</option>
            <option value="sent" <?= ($orderInfo['status'] == 'sent' ? 'selected' : '') ?>>Enviado</option>
            <option value="completed" <?= ($orderInfo['status'] == 'completed' ? 'selected' : '') ?>>Completado</option>
            <option value="canceled" <?= ($orderInfo['status'] == 'canceled' ? 'selected' : '') ?>>Cancelado</option>
            <option value="refund" <?= ($orderInfo['status'] == 'refund' ? 'selected' : '') ?>>Devolución</option>
          </select>
        </div>

        <div>
          <label class="text-sm text-gray-600">ID Cliente</label>
          <input type="text" name="customerId" value="<?= $orderInfo['customerId'] ?>"
            readonly class="bg-gray-100 w-full mt-1 rounded-lg border-b py-2 px-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
          <label class="text-sm text-gray-600">Nombre del Cliente</label>
          <input type="text" name="firstName" value="<?= $orderInfo['firstName'] ?>"
            class="w-full mt-1 rounded-lg border-b py-2 px-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
          <label class="text-sm text-gray-600">Producto</label>
          <input type="text" name="productName" value="<?= $orderInfo['productName'] ?>"
            readonly class="bg-gray-100 w-full mt-1 rounded-lg border-b py-2 px-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
          <label class="text-sm text-gray-600">ID Producto</label>
          <input type="text" name="productId" value="<?= $orderInfo['productId'] ?>"
            readonly class="bg-gray-100 w-full mt-1 rounded-lg border-b py-2 px-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
          <label class="text-sm text-gray-600">Cantidad</label>
          <input type="number" name="quantity" value="<?= $orderInfo['quantity'] ?>"
            class="w-full mt-1 rounded-lg border-b py-2 px-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
          <label class="text-sm text-gray-600">Precio Unitario</label>
          <input type="number" step="0.01" name="productUnitPrice" value="<?= $orderInfo['productUnitPrice'] ?>"
            readonly class="bg-gray-100 w-full mt-1 rounded-lg border-b py-2 px-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
          <label class="text-sm text-gray-600">Subtotal</label>
          <input type="number" step="0.01" name="subtotal" value="<?= $orderInfo['subtotal'] ?>"
            class="w-full mt-1 rounded-lg border-b py-2 px-2">
        </div>

        <div>
          <label class="text-sm text-gray-600">Fecha</label>
          <input type="datetime-local" name="insertedOn" value="<?= $orderInfo['insertedOn'] ?>"
            class="w-full mt-1 rounded-lg border-b py-2 px-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
          <label class="text-sm text-gray-600">Método de Pago</label>
          <select name="status"
            class="w-full mt-1 rounded-lg border-b py-2 px-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            <option value="1" <?= ($orderInfo['paymentId'] == '1' ? 'selected' : '') ?>>Tarjeta crédito/débito</option>
            <option value="2" <?= ($orderInfo['paymentId'] == '2' ? 'selected' : '') ?>>Paypal</option>
            <option value="3" <?= ($orderInfo['paymentId'] == '3' ? 'selected' : '') ?>>Stripe</option>
          </select>
        
        </div>

        <div>
          <label class="text-sm text-gray-600">Nº Transacción</label>
          <input type="text" name="transactionId" value="<?= $orderInfo['transactionId'] ?>"
            readonly class="bg-gray-100 w-full mt-1 rounded-lg border-b py-2 px-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
          <label class="text-sm text-gray-600">Método de envío</label>
          <select name="status"
            class="w-full mt-1 rounded-lg border-b py-2 px-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            <option value="1" <?= ($orderInfo['shippingId'] == '1' ? 'selected' : '') ?>>UPS Standard</option>
            <option value="2" <?= ($orderInfo['shippingId'] == '2' ? 'selected' : '') ?>>DHL Standard</option>
            <option value="3" <?= ($orderInfo['shippingId'] == '3' ? 'selected' : '') ?>>DHL express</option>
          </select>
        </div>

        <div class="md:col-span-1">
          <label class="text-sm text-gray-600">ID Dirección</label>
          <input type="text" name="addressId" value="<?= $orderInfo['addressId'] ?>"
            class="w-full mt-1 rounded-lg border-b py-2 px-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500">
        </div>

      </div>

      <div class="flex justify-end gap-3 mt-6">
        <a href="orders.php" class="rounded-lg border-b py-2 px-2 bg-gray-300 hover:bg-gray-400 text-gray-800">
          Cancelar
        </a>
        <button class="rounded-lg border-b py-2 px-2 bg-accent text-white">
          Guardar Cambios
        </button>
      </div>

    </div>
  </div>
  <?php endif ?>
  <div>
    <small class="text-lg ">Last 20 orders</small>
  </div>
  <div>
    <form id="search-order" class="relative">
      <input type="search" placeholder="Order number..." id="input-user-filter" class="rounded-lg border-b py-2 px-2 shadow border bg-white border-accent w-100">
      <button type="submit"><i class="fa-solid fa-search absolute top-3.5 transform left-94"></i></button>

    </form>
  </div>
  <div class="flex flex-wrap gap-10" id="list-orders">
    <?php 
    foreach($orders as $order):
      showOrder($order);
    endforeach
    ?>
  </div>
  <script src="/student023/shop/js/backend_orders.js"></script>
</main>
<?php require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/footer.php'?>