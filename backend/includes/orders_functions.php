<?php 

function showOrder($order){
  echo '<div class="bg-primary/90 text-text border border-gray-200 rounded-xl p-4 shadow mb-4 h-60 flex flex-col w-60">
    
    <div class="flex justify-between items-center mb-2">
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


?>

