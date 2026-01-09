    <?php
        require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/admin_header.php');
        require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/config/db_connect.php');
    ?>
    <main class="px-10 bg-secondary w-full">
        <h1 class="text-black text-xl pt-5 pb-5">¡Bienvenido al panel de administracion!</h1>
        <?php
            if (!$connect) {
                echo "<p>Eror".mysqli_connect_error().'</p>';
            } else {
                echo "<p>It works!</p>";
            }
        ?>
        <a href="../index.html" class="text-2xl bg-btn rounded p-5">Riff Store</a>
    </main>
    <?php require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/footer.php'); ?>