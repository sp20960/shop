<?php require($_SERVER['DOCUMENT_ROOT'] . '/student023/shop/backend/includes/guest_header.php'); ?>

<main class="px-100">
    <section class="flex justify-center pt-20 gap-5">
        <div class="border border-primary h-13 rounded-full px-2 bg-accent">
            <i class="fa-solid fa-lock fa-2xl mt-6"></i>
        </div>
        <hr class="w-70 mt-6">
        <div class="border border-primary h-13 rounded-full px-2 bg-accent">
            <i class="fa-solid fa-location-dot fa-2xl mt-6"></i>
        </div>
        <hr class="w-70 mt-6">
        <div class="border border-primary h-13 rounded-full px-2">
            <i class="fa-solid fa-truck fa-2xl mt-6"></i>
        </div>
        <hr class="w-70 mt-6">
        <div class="border border-primary h-13 rounded-full px-2">
            <i class="fa-solid fa-credit-card fa-2xl mt-6"></i>
        </div>
        <hr class="w-70 mt-6">
        <div class="border border-primary h-13 rounded-full px-2">
            <i class="fa-solid fa-clipboard-list fa-2xl mt-6"></i>
        </div>
    </section>

    <section class="mt-20">
        <h2 class="font-latobold text-4xl">¿Cual es tu dirección?</h2>
        <div class="pt-10">
            <h3 class="font-latobold text-2xl">Dirección</h3>
            <form action="" class="flex flex-col pt-5 gap-10">
                <input type="text" name="nif" placeholder="Empresa/Institución/NIF/DNI" class="p-5 shadow-xl text-xl rounded-lg"/>
                <div class="flex gap-5">
                    <input type="text" name="firstName" placeholder="Nombre" class="p-5 shadow-xl text-xl w-1/2 rounded-lg" required />
                    <input type="text" name="lastName" placeholder="Apellidos" class="p-5 shadow-xl text-xl w-1/2 rounded-lg" required />
                </div>
                  
            </form>
        </div>

        <div>

        </div>
    </section>
</main>