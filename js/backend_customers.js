//REFACTORED!!!! showCustomers will be in the backend asap
document.addEventListener("DOMContentLoaded", () => {
  const searchCustomer = document.getElementById("search-customer");
  const listCustomers = document.getElementById("list-customers");
  const inputUserFilter = document.getElementById('input-user-filter');

  async function filterRequest(userFilter) {
    const fd = new FormData();
    fd.append("userInput", userFilter);

    const customers = await fetchDataPost('/student023/shop/backend/endpoints/db_customer_search.php',
                                        fd, true);
    showcustomers(customers);
  }

  function showcustomers(customer) {
      listCustomers.innerHTML = 
      customer.map((customer) =>( 
        `
          <div class="bg-primary/90 text-text border border-gray-200 rounded-xl p-4 shadow mb-4 w-100 flex flex-col min-h-60">
    
    <div class="flex justify-between items-center mb-2">
        <span class="text-lg font-bold">#${customer.customerId} </span>
        <span class="px-3 py-1 rounded-full text-white text-sm bg-accent">
            ${customer.isEnabled == 1 ? 'habilitado' : 'deshabilitado'}
        </span>
    </div>

    <div class="text-text space-y-1">
        <p><span class="font-semibold">Nombre:</span> ${customer.firstName == null ? 'No hay datos' : customer.firstName}</p>
        <p><span class="font-semibold">Apellidos:</span> ${customer.lastName == null ? 'No hay datos' : customer.lastName}</p>
        <p><span class="font-semibold">Fecha:</span>${customer.email}</p>
    </div>

    <div class="flex gap-2 mt-4">
        <a href="customers.php?c=${customer.customerId}" class="px-4 py-2 rounded-lg bg-accent text-white hover:bg-gray-700 transition">
            Ver
        </a>
    </div>

</div>
        `
      )).join("")
    }

  searchCustomer.addEventListener("submit", (e) => {
    e.preventDefault();
    filterRequest(inputUserFilter.value);
  });
});
