<script>
  document.addEventListener('DOMContentLoaded', function() {
    const addProductBtn = document.getElementById('add-product-btn');
    const productsTable = document.getElementById('products-table').querySelector('tbody');
    const totalInput = document.getElementById('total');
    const searchInput = document.getElementById('product-search');
    const productList = document.getElementById('product-list');

    let selectedProducts = [];

    addProductBtn.addEventListener('click', function() {
      $('#select-product-modal').modal('show');
    });

    document.addEventListener('click', function(e) {
      if (e.target.classList.contains('btn-select-product')) {
        const productId = e.target.closest('tr').dataset.productId;
        const productName = e.target.closest('tr').dataset.productName;
        const productPrice = e.target.closest('tr').dataset.productPrice;

        if (selectedProducts.includes(productId)) {
          alert('Este producto ya ha sido seleccionado.');
          return;
        }

        const row = document.createElement('tr');
        row.dataset.productId = productId;
        row.innerHTML = `
                    <td>${productName}</td>
                    <td>S/${productPrice}</td>
                    <td><input type="number" class="form-control quantity-input" name="quantity[]" value="1" min="1"></td>
                    <td class="row-total">${(productPrice * 1).toFixed(2)}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-product">Eliminar</button>
                    </td>
                    <input type="hidden" name="product_id[]" value="${productId}">
                    <input type="hidden" name="unit_price[]" value="${productPrice}"> <!-- Añadir esto -->
                `;

        productsTable.appendChild(row);
        selectedProducts.push(productId);
        $('#select-product-modal').modal('hide');
        updateTotal();
        updateProductList();
      }
    });

    productsTable.addEventListener('input', function(e) {
      if (e.target.classList.contains('quantity-input')) {
        const row = e.target.closest('tr');
        const quantity = parseInt(e.target.value, 10);
        const price = parseFloat(row.querySelector('td:nth-child(2)').textContent.replace('S/', ''));
        const rowTotal = row.querySelector('.row-total');

        rowTotal.textContent = (price * quantity).toFixed(2);
        updateTotal();
      }
    });

    productsTable.addEventListener('click', function(e) {
      if (e.target.classList.contains('remove-product')) {
        const row = e.target.closest('tr');
        const productId = row.dataset.productId;

        row.remove();
        selectedProducts = selectedProducts.filter(id => id !== productId);
        updateTotal();
        updateProductList();
      }
    });

    function updateTotal() {
      let total = 0;
      productsTable.querySelectorAll('.row-total').forEach(function(td) {
        total += parseFloat(td.textContent);
      });
      totalInput.value = total.toFixed(2);
    }

    function updateProductList() {
      const rows = productList.querySelectorAll('tr');
      rows.forEach(row => {
        const productId = row.dataset.productId;
        if (selectedProducts.includes(productId)) {
          row.style.display = 'none';
        } else {
          row.style.display = '';
        }
      });
    }

    searchInput.addEventListener('input', function() {
      const searchTerm = searchInput.value.toLowerCase();
      const rows = productList.querySelectorAll('tr');
      rows.forEach(row => {
        const productName = row.dataset.productName.toLowerCase();
        if (productName.includes(searchTerm)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
      updateProductList();
    });
  });
</script>
