//REFACTORED !!! I need to handle how to convert de subtotal in a DECIMAL 10,2
document.addEventListener('DOMContentLoaded', () => {
  const urlShoppingCartUpdateEndpoint = "/student023/shop/backend/endpoints/db_shopping_cart_update.php"
  const minusIcons = document.querySelectorAll('#minus-icon');
  const plusIcon = document.querySelectorAll('#plus-icon');

  async function updateShoppingCart(quantity, productId) {

    const fd = new FormData();
    fd.append("quantity", quantity);
    fd.append("productId", productId);

    const subotals = await fetchDataPost(urlShoppingCartUpdateEndpoint, fd, true)
    console.log(subotals)

    updateTotal(subotals)
  }

  function updateTotal(subtotals) {
    let totalPrice = 0;
    subtotals.forEach((product) => {
      totalPrice += parseInt(product.subtotal);
    });
    document.getElementById('total-price').innerText = +totalPrice;
  }

  minusIcons.forEach((icon) => {
    icon.addEventListener('click', (e) => {
      let quantity = e.target.nextSibling;
      if (+quantity.innerText === 1) {
        return;
      }

      quantity.innerText = +quantity.innerText - 1
      let productId = e.target.parentElement.attributes['data-product'].value;

      updateShoppingCart(quantity.innerText, productId);
    });
  });

  plusIcon.forEach((icon) => {
    icon.addEventListener('click', (e) => {
      let quantity = e.target.previousSibling;
      if (+quantity.innerText === 12) {
        return;
      }

      quantity.innerText = +quantity.innerText + 1
      let productId = e.target.parentElement.attributes['data-product'].value;

      updateShoppingCart(quantity.innerText, productId);
    });
  });

  showMessage();
});