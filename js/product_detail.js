document.addEventListener('DOMContentLoaded', () => {
  const urlProductsRelatedEndpoint = "/student023/shop/backend/endpoints/db_products_enabled.php"
  const actualImage = document.getElementById('actual-image');
  const allImages = document.querySelectorAll('#all-images img');
  let productsToAdd = JSON.parse(localStorage.getItem('products')) || {products: []}
  const listRelatedProducts = document.getElementById('list-related-products');


  async function loadRelatedProducts() {
    try {
      const response = await fetch(urlProductsRelatedEndpoint);
      const products = await response.json();
      showRelatedProducts(products);
    } catch (error) {
      listProducts.innerHTML = "<h1>¡Ha habido un problema cargando los productos!</h1>";
    }
  }

  function showRelatedProducts(products) {
    if (products != null && products.length != 0) {
      listRelatedProducts.innerHTML = products
        .map((product) =>
          `
           <article class="card" data-product-id="${product.productId}">
                <img class="w-[130px] h-[130px]" src="${product.imagePath}" alt="">
                <div class="flex items-center justify-start w-full">
                    <i class="fa-regular fa-star fa-sm"></i>
                    <i class="fa-regular fa-star fa-sm"></i>
                    <i class="fa-regular fa-star fa-sm"></i>
                    <i class="fa-regular fa-star fa-sm"></i>
                    <i class="fa-regular fa-star fa-sm"></i>
                    <p class="text-base font-latobold">(0)</p>
                </div>
                <div class="text-start w-full">
                    <h3 class="font-latobold text-xl">${product.productName}</h3>
                    <p class="font-latobold text-2xl">${product.pricePerUnit} €</p>
                </div>
                <div class="card-buy flex justify-center bg-accent p-[5px] rounded-2xl w-full cursor-pointer font-latobold font-extrabold">
                    Añadir
                </div>
            </article>
        `
        ).join("");
      addEventRelatedProducts();
      addEventRelatedAddToCart();
      addEventRelatedCardBuy();
    } else {
      listRelatedProducts.innerHTML = "<h1>¡No hay productos disponibles!</h1>";
    }
  }

  function addEventRelatedProducts() {
    const products = document.querySelectorAll('.card img');
    products.forEach((product) => {
      product.addEventListener('click', (e) => {
        const productId = product.parentElement.dataset.productId;
        location.href = `product_detail.html?id=${productId}`;
      })
    })
  }

  function addEventRelatedAddToCart(){
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

  function addEventRelatedCardBuy() {
    document.querySelectorAll('.card-buy').forEach((btn) => {
      btn.addEventListener('click', () => {
        btn.innerHTML = '<i class="fa-solid fa-check"></i>';

        setTimeout(() => {
          btn.innerHTML = '<i class="fa-solid fa-cart-shopping text-text!"></i>';
        }, 1500);
      })
    });
  }
  
  async function addToShoppingCart(productId) {
    const endpointnUrl = `/student023/shop/backend/endpoints/db_shopping_cart_insert.php?productId=${productId}`
    try {
      const response = await fetch(endpointnUrl)
      const result = response;
      
    } catch (error) {

    }
  }

  allImages.forEach((image) => {
    image.addEventListener('click', () => {
      allImages.forEach((image) => {
        image.classList.remove('active-image')
      })
      let srcImage = image.src
      srcImage = srcImage.replace(".png", ".jpg")
      actualImage.src = srcImage
      image.classList.add('active-image')
    });
  });

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
  }

  loadRelatedProducts();
})