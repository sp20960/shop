    <?php
        require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/admin_header.php');
        require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/config/db_connect.php');
        require $_SERVER['DOCUMENT_ROOT'].'/student023/shop/backend/includes/helpers_function.php';
        $weatherInfo = getWeatherInfo()[0];
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
        <div class="mt-10">
          <small><?= $weatherInfo['LocalObservationDateTime'] ?></small>
          <div class="bg-primary/90 shadow-2xl rounded-lg p-5 text-text flex justify-between items-center w-80">
            <div>
              <img src="/student023/shop/assets/images/weather_icons/<?= $weatherInfo['WeatherIcon'] ?>.svg" alt="weather icon"> 
            </div>
            <div> 
              <h2 class="text-4xl font-extrabold"><?= $weatherInfo['Temperature']['Metric']['Value'] ?> Cº</h2>
            </div>
          </div>
        </div>

        <div class="mt-15 flex justify-between w-full">
          <div class="w-1/2 flex flex-col items-center">
            <select id="bar-chart-year" class=" border-b text-2xl px-5 font-latobold shadow-2xl">
              <option value="2025">2025</option>
              <option value="2026" selected>2026</option>
            </select>
            <canvas class="w-30" id="bar-chart"></canvas>
          </div>
          <div class="w-1/2 h-100 flex justify-center">
            <canvas class="w-30" id="pie-chart"></canvas>
          </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1"></script>
    <script src="../js/utils.js"></script>
    <script type="module" src="../js/backend_index.js"></script>
    <?php require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/footer.php'); ?>