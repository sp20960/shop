<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/security/check_session.php');
$nickname = $_SESSION['user']['firstName'] ?? 'CUSTOMER';
$nickname = strtoupper($nickname);
if (isset($_POST['logout']) && isset($_SESSION['user'])) {
    session_destroy();
    header("Location: http://".$_SERVER['SERVER_NAME'].'/student023/shop/') ;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de administracion</title>
    <link href="/student023/shop/assets/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="/student023/shop/assets/fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="/student023/shop/css/style.css">
    <link rel="shortcut icon" href="/student023/shop/assets/images/brand/favicon.png" type="image/x-icon">
</head>

<body class="flex">
    <header class="flex flex-col bg-primary  min-h-screen">
        <div class="py-9 flex items-center px-3">
            <div class="py-7 px-2 flex justify-center border border-white w-15 rounded-md">
                <i class="fa-regular fa-circle-user fa-2xl text-text cursor-pointer" id="profile"></i>
                <div class="absolute bg-white w-30 h-20 translate-x-[50%] translate-y-[20%] transform hidden flex-col rounded-sm" id="profile-dropdown-content">
                    <hr>
                    <form action="/student023/shop/backend/index.php" method="POST" class="pl-2">
                        <input type="submit" name="logout" value="Log Out" class="cursor-pointer">
                    </form>
                    <hr>
                </div>
            </div>
            <div class="border h-[60px] w-full border-white rounded-md flex items-center px-5">
                <p class="text-text">Bienvenido al panel, <?= htmlspecialchars($nickname);?></p>
            </div>
        </div>

        <div class="flex flex-col px-15">
            <div class="cursor-pointer flex justify-center" id="logo">
                <img src="/student023/shop/assets/images/brand/logo_claro.png" alt="" class="w-10">
            </div>
            <?php 
                if($_SESSION['user']['rol'] == "admin"){ 
                    require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/admin_nav.php');
                }else { 
                    require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/customer_nav.php');
                } 
            ?>
        </div>
    </header>