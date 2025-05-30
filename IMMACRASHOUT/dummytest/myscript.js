document.addEventListener("DOMContentLoaded", function () {
  // Initialize menu items with stock data
  const menuItems = {
    1: { name: "Menu 1", price: 15000, stock: 100, initialStock: 10 },
    2: { name: "Menu 2", price: 10000, stock: 15, initialStock: 15 },
    3: { name: "Menu 3", price: 20000, stock: 8, initialStock: 8 },
    4: { name: "Menu 4", price: 8000, stock: 20, initialStock: 20 },
    5: { name: "Menu 5", price: 12000, stock: 20, initialStock: 20 },
    6: { name: "Menu 5", price: 100000, stock: 5, initialStock: 10 },
  };

  let cart = [];
  let grandTotal = 0;

  // Initialize stock display
  function initializeStockDisplay() {
    for (const id in menuItems) {
      const stockElement = document.getElementById(`stock-${id}`);
      if (stockElement) {
        stockElement.textContent = menuItems[id].stock;
        updateAddButtonState(id);
      }
    }
  }

  // Update add to cart button state
  function updateAddButtonState(id) {
    const addButton = document.querySelector(`.add-to-cart[data-id="${id}"]`);
    if (addButton) {
      addButton.disabled = menuItems[id].stock <= 0;
      addButton.classList.toggle("disabled", menuItems[id].stock <= 0);
    }
  }

  initializeStockDisplay();

  // Add to Cart functionality
  document.querySelectorAll(".add-to-cart").forEach((button) => {
    button.addEventListener("click", function () {
      const id = this.getAttribute("data-id");
      const itemData = menuItems[id];

      if (itemData.stock <= 0) {
        alert("This item is out of stock!");
        return;
      }

      const existingItem = cart.find((item) => item.id === id);

      if (existingItem) {
        if (existingItem.quantity < itemData.initialStock) {
          existingItem.quantity++;
          existingItem.total = existingItem.quantity * itemData.price;
        } else {
          alert("Cannot add more than available stock!");
          return;
        }
      } else {
        cart.push({
          id,
          name: itemData.name,
          price: itemData.price,
          quantity: 1,
          total: itemData.price,
        });
      }

      // Update stock in memory and display
      itemData.stock--;
      updateStockDisplay(id);
      updateCartDisplay();
    });
  });

  // Update stock display for a specific item
  function updateStockDisplay(id) {
    const stockElement = document.getElementById(`stock-${id}`);
    if (stockElement) {
      stockElement.textContent = menuItems[id].stock;
      updateAddButtonState(id);
    }
  }

  // Update cart display
  function updateCartDisplay() {
    const cartItemsElement = document.getElementById("cart-items");
    const grandTotalElement = document.getElementById("grand-total");
    const checkoutBtn = document.getElementById("checkout-btn");

    cartItemsElement.innerHTML = "";
    grandTotal = 0;

    cart.forEach((item) => {
      const row = document.createElement("tr");
      row.innerHTML = `
              <td>${item.name}</td>
              <td>Rp ${item.price.toLocaleString()}</td>
              <td>
                <div class="input-group input-group-sm">
                  <button class="btn btn-outline-danger decrement" data-id="${item.id}">-</button>
                  <input type="text" class="form-control text-center" value="${item.quantity}" readonly>
                  <button class="btn btn-outline-danger increment" data-id="${item.id}">+</button>
                </div>
              </td>
              <td>Rp ${item.total.toLocaleString()}</td>
              <td><button class="btn btn-sm btn-outline-danger remove" data-id="${item.id}">Remove</button></td>
            `;
      cartItemsElement.appendChild(row);
      grandTotal += item.total;
    });

    grandTotalElement.textContent = `Rp ${grandTotal.toLocaleString()}`;
    checkoutBtn.disabled = cart.length === 0;

    addCartItemEventListeners();
  }

  // Add event listeners to cart item buttons
  function addCartItemEventListeners() {
    // Increment quantity
    document.querySelectorAll(".increment").forEach((button) => {
      button.addEventListener("click", function () {
        const id = this.getAttribute("data-id");
        const item = cart.find((item) => item.id === id);

        if (item.quantity < menuItems[id].initialStock) {
          item.quantity++;
          item.total = item.quantity * item.price;
          menuItems[id].stock--;
          updateStockDisplay(id);
          updateCartDisplay();
        } else {
          alert("Maximum available quantity reached for this item!");
        }
      });
    });

    // Decrement quantity
    document.querySelectorAll(".decrement").forEach((button) => {
      button.addEventListener("click", function () {
        const id = this.getAttribute("data-id");
        const item = cart.find((item) => item.id === id);

        if (item.quantity > 1) {
          item.quantity--;
          item.total = item.quantity * item.price;
          menuItems[id].stock++;
          updateStockDisplay(id);
          updateCartDisplay();
        }
      });
    });

    // Remove item
    document.querySelectorAll(".remove").forEach((button) => {
      button.addEventListener("click", function () {
        const id = this.getAttribute("data-id");
        const itemIndex = cart.findIndex((item) => item.id === id);
        const item = cart[itemIndex];

        // Return all quantity to stock
        menuItems[id].stock += item.quantity;
        updateStockDisplay(id);

        // Remove from cart
        cart.splice(itemIndex, 1);
        updateCartDisplay();
      });
    });
  }

  // Checkout button
  document.getElementById("checkout-btn").addEventListener("click", function () {
    document.getElementById("payment-amount").textContent = `Rp ${grandTotal.toLocaleString()}`;
  });

  // Confirm payment button - FINALIZES THE ORDER
  document.getElementById("confirm-payment").addEventListener("click", function () {
    if (cart.length === 0) {
      alert("Your cart is empty!");
      return;
    }

    // Create order summary
    let orderSummary = "Order confirmed!\n\n";
    cart.forEach((item) => {
      orderSummary += `${item.name} x${item.quantity} = Rp ${item.total.toLocaleString()}\n`;
    });
    orderSummary += `\nTotal: Rp ${grandTotal.toLocaleString()}`;

    alert(orderSummary);

    // Clear the cart but DON'T restore stock (it's already been deducted)
    cart.length = 0;
    updateCartDisplay();

    // Close modal
    const modal = bootstrap.Modal.getInstance(document.getElementById("paymentModal"));
    modal.hide();

    // Show success message
    const successAlert = document.createElement("div");
    successAlert.className = "alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3";
    successAlert.style.zIndex = "1100";
    successAlert.innerHTML = `
            <strong>Order successful!</strong> Your food will be ready soon.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          `;
    document.body.appendChild(successAlert);

    // Auto-dismiss after 5 seconds
    setTimeout(() => {
      const bsAlert = new bootstrap.Alert(successAlert);
      bsAlert.close();
    }, 5000);
  });

  // Cafetaria filter with image display
  document.getElementById("cafetaria-select").addEventListener("change", function () {
    const selectedCafetaria = this.value;
    const menuItems = document.querySelectorAll(".menu-item");

    // Hide all canteen images first
    document.querySelectorAll(".canteen-img").forEach((img) => {
      img.style.display = "none";
    });

    // Show the selected canteen's image (if not "all")
    if (selectedCafetaria !== "all") {
      const canteenImg = document.getElementById(`canteen-${selectedCafetaria}`);
      if (canteenImg) {
        canteenImg.style.display = "block";
      }
    }

    // Filter menu items
    menuItems.forEach((item) => {
      const cafetaria = item.getAttribute("data-cafetaria");

      if (selectedCafetaria === "all" || cafetaria === selectedCafetaria) {
        item.classList.remove("hidden");
      } else {
        item.classList.add("hidden");
      }
    });
  });
});
