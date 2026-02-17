<?php 
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/admin_header.php';
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/security/protect_admin_pages.php');
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/db/customers/db_select_customers.php';
require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/customers_functions.php';

?>

<main class="flex flex-col px-10 py-10 gap-5 font-latobold bg-secondary w-screen">
  <div>
    <small class="text-lg ">Last 20 customers</small>
  </div>

  <?php 
    if(isset($_GET['c'])):
      $customerId = $_GET['c'];
      $customerInfo = returnCustomerData($customerId)[0];
  ?>
  <!-- Overlay -->
  <div class="fixed inset-0 bg-black/40 z-40"></div>

  <!-- Modal -->
  <div class="fixed inset-0 z-50 flex items-center justify-center">
    <div class="bg-white w-full max-w-3xl max-h-[90vh] overflow-y-auto rounded-xl shadow-2xl p-6">

      <h2 class="text-2xl font-semibold text-center mb-6">
        Detalles del Cliente
      </h2>

      <!-- Cliente info -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <!-- Solo lectura -->
        <div>
          <label class="text-sm text-gray-600">ID Cliente</label>
          <input type="text" name="customerId" value="<?= $customerInfo['customerId'] ?>" readonly
            class="w-full mt-1 rounded-lg border-b px-2 py-2 bg-gray-100 border-gray-300">
        </div>

        <div>
          <label class="text-sm text-gray-600">Fecha de Alta</label>
          <input type="datetime-local" name="insertedOn" readonly
            value="<?= $customerInfo['insertedOn'] ?>" class="w-full mt-1 rounded-lg border-b px-2 py-2 bg-gray-100 border-gray-300">
        </div>

        <!-- Datos personales -->
        <div>
          <label class="text-sm text-gray-600">Nombre</label>
          <input type="text" name="firstName" value="<?= $customerInfo['firstName'] ?>"
            class="w-full mt-1 rounded-lg border-b px-2 py-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
          <label class="text-sm text-gray-600">Apellidos</label>
          <input type="text" name="lastName" value="<?= $customerInfo['lastName'] ?>"
            class="w-full mt-1 rounded-lg border-b px-2 py-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
          <label class="text-sm text-gray-600">NIF</label>
          <input type="text" name="nif" value="<?= $customerInfo['nif'] ?>"
            class="w-full mt-1 rounded-lg border-b px-2 py-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
          <label class="text-sm text-gray-600">Teléfono</label>
          <input type="text" name="phone" value="<?= $customerInfo['phone'] ?>"
            class="w-full mt-1 rounded-lg border-b px-2 py-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div class="md:col-span-2">
          <label class="text-sm text-gray-600">Email</label>
          <input type="email" name="email" value="<?= $customerInfo['email'] ?>"
            class="w-full mt-1 rounded-lg border-b px-2 py-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500">
        </div>

        <!-- Seguridad -->
        <div>
          <label class="text-sm text-gray-600">Nueva contraseña</label>
          <input type="password" name="pwd"
            placeholder="••••••••"
            class="w-full mt-1 rounded-lg border-b px-2 py-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500">
          <p class="text-xs text-gray-400 mt-1">
            Déjalo vacío para no cambiarla
          </p>
        </div>

        <!-- Rol -->
        <div>
          <label class="text-sm text-gray-600">Rol</label>
          <select name="rol"
            class="w-full mt-1 rounded-lg border-b px-2 py-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            <option value="user" <?= ($customerInfo['rol'] == 'customer' ? 'selected' : '') ?>>Usuario</option>
            <option value="admin" <?= ($customerInfo['rol'] == 'admin' ? 'selected' : '') ?>>Administrador</option>
          </select>
        </div>

        <!-- Imagen -->
        <div class="md:col-span-2">
          <label class="text-sm text-gray-600">Imagen de Perfil</label>
          <div class="flex items-center gap-4 mt-2">
            <img
              src="<?= $customerInfo['imagePath'] ?>"
              alt="Avatar"
              class="w-20 h-20 rounded-full object-cover border"
            >
            <input type="file" name="imagePath"
              class="block w-full text-sm text-gray-500">
          </div>
        </div>

        <!-- Estado -->
        <div class="md:col-span-2">
          <label class="text-sm text-gray-600">Estado de la Cuenta</label>
          <select name="isEnabled"
            class="w-full mt-1 rounded-lg border-b px-2 py-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            <option value="1" <?= ($customerInfo['isEnabled'] == '1' ? 'selected' : '') ?>>Activa</option>
            <option value="0" <?= ($customerInfo['isEnabled'] == '0' ? 'selected' : '') ?>>Desactivada</option>
          </select>
        </div>

      </div>

      <!-- Actions -->
      <div class="flex justify-end gap-3 mt-6">
        <a href="customers.php" class="px-5 py-2 rounded-lg border-b bg-gray-300 hover:bg-gray-400 text-gray-800">
          Cerrar
        </a>
        <button class="px-5 py-2 rounded-lg border-b bg-blue-600 hover:bg-blue-700 text-white">
          Guardar Cambios
        </button>
      </div>

    </div>
  </div>
  <?php endif; ?>

  <div>
    <form id="search-customer" class="relative">
      <input type="search" placeholder="customer email..." id="input-user-filter" class="rounded-lg border-bshadow px-2 py-2 bcustomer bg-white bcustomer-accent w-100">
      <button type="submit"><i class="fa-solid fa-search absolute top-3.5 transform left-94"></i></button>

    </form>
  </div>
  <div class="flex flex-wrap gap-10" id="list-customers">
    <?php 
    foreach($customers as $customer):
      showCustomer($customer);
    endforeach
    ?>
  </div>
  <script src="/student023/shop/js/backend_customers.js"></script>
</main>
<?php require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/footer.php'?>