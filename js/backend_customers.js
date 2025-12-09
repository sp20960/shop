document.addEventListener("DOMContentLoaded", () => {
  const searchCustomer = document.getElementById("search-customer");
  const listCustomers = document.getElementById("list-customers");
  const inputUserFilter = document.getElementById('input-user-filter');

  function filterRequest(userFilter) {
    let params = 'userInput=' + encodeURIComponent(userFilter);

    let xhttp = new XMLHttpRequest();

    xhttp.open('POST', '/student023/shop/backend/endpoints/db_customer_search.php', true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhttp.onreadystatechange = function() {
      if(xhttp.readyState == 4 && xhttp.status == 200){
        showcustomers(JSON.parse(xhttp.responseText));
      }
    }

    xhttp.send(params);
  }

  function showcustomers(customer) {
      listCustomers.innerHTML = 
      customer.map((customer) =>( 
        `
          <div class="bg-primary/90 text-text border border-gray-200 rounded-xl p-4 shadow mb-4 w-60 flex flex-col min-h-60">
    
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

  searchCustomer.addEventListener("submit", (e) => {
    e.preventDefault();
    filterRequest(inputUserFilter.value);
  });
});
