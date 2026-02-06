document.addEventListener('DOMContentLoaded', () => {
  const urlProductsEndpoint = "/student023/shop/backend/endpoints/db_products_enabled.php";
  const urlLoadShoppingCart = "/student023/shop/backend/endpoints/db_product_by_id.php";
  const listFeaturedProducts = document.getElementById('list-featured-products');
  let productsToAdd = JSON.parse(localStorage.getItem('products')) || {products: []}
  let listShoppingCart = document.getElementById('shopping-cart-products')
 

  async function checkLocalStorage() {
    const logged = await isLogged();

    if(!productsToAdd.products[0]) {
      listShoppingCart.innerHTML = "<h1>No hay productos :(</h1>"
    }

    if (productsToAdd.products[0] && logged === 'false') {
      listShoppingCart.innerHTML = ""
      for (const product of productsToAdd.products) {
        showLocalStorageProducts(product);
      }
    }

    if (productsToAdd && logged === 'true') {
      for (const product of productsToAdd.products) {
        fetchInsertShoppingCart(product.productId);
      }
      localStorage.clear();
    }

    if (logged === 'true') {
      fetchShoppingCartProducts();
    }

  }

  async function fetchInsertShoppingCart(productId) {
    try {
      await fetchDataGet(`/student023/shop/backend/endpoints/db_shopping_cart_insert.php?productId=${productId}`, false);
      fetchShoppingCartProducts();
    } catch (error) {
      console.log(error)
    }

  }

  async function fetchShoppingCartProducts() {
    try {
      const endpoint = '/student023/shop/backend/endpoints/db_select_shopping_cart_by_customer_id.php'
      const products = await fetchDataGet(endpoint, true, false);
      listShoppingCart.innerHTML = products === "" 
      ? '<h1>No hay productos a enseñar :(</h1>' 
      : products;
      addEventTrash();
      updateSubtotal();
      addEventQuantity();
    } catch (error) {

    }
  }

  function showLocalStorageProducts(product) {
    let params = "productId=" + encodeURIComponent(product.productId) +
      "&quantity=" + encodeURIComponent(product.qty);

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", urlLoadShoppingCart, true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
        listShoppingCart.innerHTML += xhttp.responseText;
        addEventQuantity();
        addEventTrash();
        updateSubtotal();
      }
    }
    xhttp.send(params)

  }


  function updateSubtotal() {
    const products = document.querySelectorAll('.shopping-cart-product');
    const subtotalPrice = document.getElementById('subtotal');

    let subtotal = 0;
    products.forEach((product) => {
      let pr = +product.dataset.productPrice;
      let quantity = +product.dataset.quantity;
      subtotal += pr * quantity;
    })
    subtotalPrice.innerText = subtotal + '€';
  
    
  }

  function addEventQuantity() {
    let inputsQuantity = document.querySelectorAll('.quantity')
    inputsQuantity.forEach((iq) => {
      iq.addEventListener('change', async (e) => {
        const logged = await isLogged();
        if(logged === "false"){
            let qty = e.target.value
            e.target.parentElement.parentElement.parentElement.parentElement.dataset.quantity = qty
            updateSubtotal();
        }else {
          await fetchInsertShoppingCart(e.target.parentElement.parentElement.parentElement.parentElement.dataset.productId)
        }
      })
    })
  }

  function addEventTrash() {
    document.querySelectorAll('.fa-trash').forEach((trash) => {
      trash.addEventListener('click', async (e) => {

        const logged = await isLogged()
        let productId = trash.parentElement.parentElement.parentElement.dataset.productId

        if (logged === 'false') {
          productsToAdd.products = productsToAdd.products.filter((product) => product.productId != productId);
          localStorage.setItem('products', JSON.stringify(productsToAdd));
          checkLocalStorage();
          
        } else {
          fetchDeleteShoppingCartProduct(productId);
        }

      })
    })
  }

  async function fetchDeleteShoppingCartProduct(productId) {
    try {
      await fetchDataGet(`/student023/shop/backend/endpoints/db_delete_shopping_cart.php?productId=${productId}`, false,)
      fetchShoppingCartProducts();
    } catch (error) {
      console.log(error)
    }
  }

  async function loadRelatedProducts() {
    try {
      const response = await fetch(urlProductsEndpoint);
      const products = await response.json();
      showFeaturedProducts(products);
    } catch (error) {
      loadRelatedProducts.innerHTML = "<h1>¡Ha habido un problema cargando los productos!</h1>";
    }
  }

  function showFeaturedProducts(products) {
    if (products != null && products.length != 0) {
      listFeaturedProducts.innerHTML = products
        .map((product) =>
          `
           <article class="card" data-product-id="${product.productId}">
                <img src="${product.imagePath}" alt="">
                <div>
                    <i class="fa-regular fa-star fa-sm"></i>
                    <i class="fa-regular fa-star fa-sm"></i>
                    <i class="fa-regular fa-star fa-sm"></i>
                    <i class="fa-regular fa-star fa-sm"></i>
                    <i class="fa-regular fa-star fa-sm"></i>
                    <p class="text-base font-latobold">(0)</p>
                </div>
                <div>
                    <h3>${product.productName}</h3>
                    <p>${product.pricePerUnit} €</p>
                </div>
                <div class="card-buy" style="font-weight:800;">
                    Añadir
                </div>
            </article>
        `
        ).join("");
      addEventProducts();
      addEventAddToCart()
      addEventCardBuy();
    } else {
      listFeaturedProducts.innerHTML = "<h1>¡No hay productos disponibles!</h1>";
    }
  }

  function addEventProducts() {
    const products = document.querySelectorAll('.card img');

    products.forEach((product) => {
      product.addEventListener('click', (e) => {
          const productId = product.parentElement.dataset.productId;
          location.href = `product_detail.html?id=${productId}`;
      })
    })
  }

  function addEventAddToCart(){
    const buttons = document.querySelectorAll('.card-buy');
    buttons.forEach((button) => {
      button.addEventListener('click', async (e) => {
        const productId = button.parentElement.dataset.productId;
        const session =  await isLogged();
        if(session === "true"){
          addToShoppingCart(productId);
        } else {
          addProductLocalStorage(productId);
        }
        
      })
    })
  }

  async function addToShoppingCart(productId) {
    const endpointnUrl = `/student023/shop/backend/endpoints/db_shopping_cart_insert.php?productId=${productId}`
    try {
      const response = fetch(endpointnUrl);
    } catch (error) {
      
    }
  }

  function addProductLocalStorage(productId) {
      let productExists = false;

      productsToAdd.products.forEach((product) => {
        if(product.productId === productId){
          let quantity = +product.qty;
          product.qty = quantity + 1;
          productExists = true
        }
      });

      if(!productExists){
        productsToAdd.products.push({productId, qty: 1});
      }
      localStorage.setItem("products", JSON.stringify(productsToAdd));
      checkLocalStorage();
  }

  function addEventCardBuy() {
     document.querySelectorAll('.card-buy').forEach((btn) => {
      btn.addEventListener('click', () => {
          btn.innerHTML = '<i class="fa-solid fa-check"></i>';

          setTimeout(() => {
              btn.innerHTML = '<i class="fa-solid fa-cart-shopping"></i>';
          }, 1500);
      })
    });
  } 

  loadRelatedProducts();
  checkLocalStorage();
})