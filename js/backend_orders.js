//REFACTORED!!! showOrders will be in the backend asap
document.addEventListener("DOMContentLoaded", () => {
  const searchOrder = document.getElementById("search-order");
  const listOrders = document.getElementById("list-orders");
  const inputUserFilter = document.getElementById('input-user-filter');

  async function filterRequest(userFilter) {
    const fd = new FormData();
    fd.append("userInput", userFilter);

    const orders = await fetchDataPost('/student023/shop/backend/endpoints/db_order_search.php',
                                        fd, true);
    showOrders(orders);
    console.log(orders)
  }

  function showOrders(orders) {
      listOrders.innerHTML = 
      orders.map((order) =>( 
        `
          <div class="bg-primary/90 border text-text border-gray-200 rounded-xl p-4 shadow mb-4 min-h-60 flex flex-col w-110">
        
        <div class="flex flex-col-reverse gap-2 items-start mb-2">
            <span class="text-lg font-bold">#${order.orderNumber}</span>
            <span class="px-3 py-1 rounded-full text-white text-sm bg-accent">
                ${order.status}
            </span>
        </div>

        <div class="text-text space-y-1">
            <p><span class="font-semibold">Cliente: </span>${order.firstName == null ? 'No hay nombre' : order.firstName}</p>
            <p><span class="font-semibold">Total: </span>${order.subtotal}</p>
            <p><span class="font-semibold">Fecha: </span>${order.insertedOn}</p>
        </div>

        <div class="flex gap-2 mt-4">
            <button class="px-4 py-2 rounded-lg bg-gray-600 text-white hover:bg-gray-700 transition">
                Ver
            </button>
            <button class="px-4 py-2 rounded-lg bg-accent text-white hover:brightness-80 transition">
                Editar
            </button>
        </div>
    </div>
        `
      )).join("")
    }

  searchOrder.addEventListener("submit", (e) => {
    e.preventDefault();
    filterRequest(inputUserFilter.value);
  });
});
