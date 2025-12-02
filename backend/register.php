<?php 
  $errors = [];
  require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/db/db_register.php';
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/student023/shop/assets/images/brand/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="/student023/shop/css/style.css">
  <link href="/student023/shop/assets/fontawesome/css/fontawesome.css" rel="stylesheet">
  <link href="/student023/shop/assets/fontawesome/css/all.css" rel="stylesheet">
  <title>Detalle Producto</title>
</head>

<body>

  <header class="header sm:justify-evenly lg:justify-center lg:gap-[70px]">

    <i class="fa-solid fa-bars fa-2xl icon lg:hidden!"></i>

    <img src="/student023/shop/assets/images/brand/logo_claro.png" alt="logo" class="w-8 cursor-pointer">

    <nav class="nav-mobile
                    lg:bg-transparent lg:static lg:flex lg:flex-row lg:gap-10 lg:p-0 
                    lg:top-auto lg:right-auto lg:h-auto lg:w-auto lg:z-0">

      <div class="flex justify-end">
        <i class="fa-solid fa-x fa-2xl cursor-pointer lg:hidden!"></i>
      </div>

      <a href="" class="link sm:text-5xl lg:text-xl">Inicio</a>

      <p id="dropdown-menu-caret"
        class="text-[2rem] cursor-pointer font-latobold sm:text-5xl lg:text-xl lg:relative">
        Tienda <i class="fa-solid fa-caret-down"></i>
      </p>

      <div id="dropdown-content"
        class="hidden flex-col gap-[10px] pl-[25px] dropdown-content-desktop">
        <a href="" class="link sm:text-5xl lg:text-xl">Guitarras electricas</a>
        <a href="" class="link sm:text-5xl lg:text-xl">Guitarras acústicas</a>
      </div>

      <a href="" class="link sm:text-5xl lg:text-xl">Ofertas</a>
      <a href="" class="link sm:text-5xl lg:text-xl">Novedades</a>
    </nav>

    <form action="#" class="relative">
      <input type="search" name="search"
        class="rounded-md h-9 border-0 w-44 bg-white sm:w-80 lg:w-[800px]">
      <i class="fa-solid fa-search fa-xl absolute top-1/2 right-0 transform -translate-x-1/2 -translate-y-1/2"></i>
    </form>

    <a href="../backend/login.php"><i class="fa-solid fa-circle-user fa-2xl icon"></i></a>
    <a href="../backend/customer/my_shopping_cart.php"><i class="fa-solid fa-cart-shopping fa-2xl icon"></i></a>
  </header>
  <main class="h-screen flex justify-center items-center bg-secondary">
    <div class="bg-primary rounded-2xl shadow-2xl flex flex-col justify-center px-6 py-12 sm:w-[60%] lg:w-150 lg:px-10">
      <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img src="/student023/shop/assets/images/brand/logo_claro.png" alt="RiffStore" class="mx-auto h-10 w-auto" />
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-white">Unete creandote una cuenta</h2>
      </div>

      <div class="flex flex-col items-center mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form action="register.php" method="POST" class="space-y-6">
          <div>
            <label for="email" class="block text-sm/6 font-medium text-gray-100">Correo electrónico</label>
            <div class="mt-2">
              <input id="email" type="email" name="email" required="email" class="block rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-accent sm:text-sm/6 sm:w-90" />
              <?php if(isset($errors['email'])):?>
                <small class="font-latobold text-red-400"><?= $errors['email'] ?></small>
              <?php endif ?>
            </div>
          </div>

          <div>
            <div class="flex items-center justify-between">
              <label for="password" class="block text-sm/6 font-medium text-gray-100">Contraseña</label>
            </div>
            <div class="mt-2">
              <input id="password" type="password" name="pwd" required autocomplete="current-password" class="block rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-accent sm:text-sm/6 sm:w-90" />
              <?php if(isset($errors['pwd'])):?>
                <small class="font-latobold text-red-400"><?= $errors['pwd'] ?></small>
              <?php endif ?>
            </div>
          </div>

          <div>
            <div class="flex items-center justify-between">
              <label for="re-password" class="block text-sm/6 font-medium text-gray-100">Confirmar contraseña</label>
            </div>
            <div class="mt-2">
              <input id="re-password" type="re-password" name="rePwd" required autocomplete="current-password" class="block rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-accent sm:text-sm/6 sm:w-90" />
              <?php if(isset($errors['rePwd'])):?>
                <small class="font-latobold text-red-400"><?= $errors['rePwd'] ?></small>
              <?php endif ?>
            </div>
          </div>

          <div>
            <button type="submit" name="register" class="flex w-full justify-center rounded-md bg-accent px-3 py-1.5 text-sm/6 font-semibold text-white hover:opacity-40 cursor-pointer focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent">Registrar</button>
          </div>
          <?php if(isset($errors['db'])):?>
            <small class="font-latobold text-red-400"><?= $errors['db'] ?></small>
          <?php endif ?>
        </form>

        <p class="mt-10 text-center text-sm/6 text-gray-400">
          Ya tienes cuenta?
          <a href="login.php" class="font-semibold text-text underline hover:opacity-40">Iniciar sesión</a>
        </p>
      </div>
    </div>
  </main>
  <script src="../js/common.js"></script>
</body>

</html>