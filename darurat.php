 <!DOCTYPE html>
<html lang="en">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  <script src="myscript.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous" />
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kantin Website</title>
    <style>
      .menu-item {
        transition: all 0.3s ease;
      }
      .menu-item.hidden {
        display: none;
      }
    </style>
  </head>
  <body>
    <?php

$conn = new mysqli("localhost", "root", "", "cafetaria");
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
// Prepare and bind
$stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);
// Execute and respond
if ($stmt->execute()) {
    echo "Message saved successfully!";
} 
/*CREATE TABLE contacts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);*/
?>

    <nav class="navbar navbar-expand-lg bg-danger navbar-dark sticky-top">
      <div class="container">
        <a class="navbar-brand" href="#About">Kantin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ms-auto">
            <a class="nav-link" href="#Cafetaria">Cafetaria List</a>
            <a class="nav-link" href="#HowToBuy">How to Buy</a>
            <a class="nav-link" href="#Contact">Contact Us</a>
          </div>
        </div>
      </div>
    </nav>

    <main>
      <div class="container py-4" id="About">
        <!-- About Section with bg-light (now properly closed) -->
        <div class="p-4 bg-light">
          <div class="container-fluid py-4">
            <div class="ms-lg-5 ms-sm-3">
              <div class="row align-items-center ms-1">
                <div class="col-md-8">
                  <h1 class="display-5 fw-bold">About Kantin</h1>
                  <p class="fs-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea fuga voluptatem accusamus odit. Voluptatem eveniet id illum corporis exercitationem nulla amet soluta, iusto iure veniam!</p>
                  <button class="btn btn-danger btn-lg" type="button" data-bs-toggle="modal" data-bs-target="#vidModal">Video Kantin</button>
                </div>
                <div class="col-md-4">
                  <img src="images/dummy-logo.png" class="img-fluid" alt="" />
                </div>
              </div>
            </div>
            <div class="text-center">
              <img src="images/Screenshot 2025-06-01 143919.png" alt="Kantin Image" class="img-fluid rounded" style="max-width: 90%" />
            </div>
          </div>
        </div>
        <!-- Closing bg-light div -->

        <!-- Cafetaria List Section -->
        <div class="p-4" id="seperator">
          <h1 class="text-center display-4 fw-bold py-2" id="Cafetaria">Cafetaria Lists</h1>
          <p class="text-center">Kantin varochili</p>
        </div>
        <div class="row row-cols-2 row-cols-lg-4 g-4 mb-4" id="menu-container">
          <div class="col menu-item" data-cafetaria="A">
            <div class="card">
              <img src="images/buburnigga.jpg" class="card-img-top" alt="Menu 1" />
              <div class="card-body">
                <h5 class="card-title">Bubur Ayam</h5>
                <p class="text">Delicious meal from canteen-a.</p>
                <p class="text-danger fw-bold">Rp 15,000</p>
                <p class="text-muted">Stock: <span id="stock-1"></span></p>
                <button class="btn btn-outline-danger btn-sm add-to-cart" data-id="1">Add to Cart</button>
              </div>
            </div>
          </div>
          <div class="col menu-item" data-cafetaria="B">
            <div class="card">
              <img src="images/popigga.jpg" class="card-img-top" alt="Menu 2" />
              <div class="card-body">
                <h5 class="card-title">Pop Ice</h5>
                <p class="card-text">Tasty beverage from canteen-b.</p>
                <p class="text-danger fw-bold">Rp 6,000</p>
                <p class="text-muted">Stock: <span id="stock-2">15</span></p>
                <button class="btn btn-outline-danger btn-sm add-to-cart" data-id="2">Add to Cart</button>
              </div>
            </div>
          </div>
          <div class="col menu-item" data-cafetaria="C">
            <div class="card">
              <img src="images/ramenigga.jpg" class="card-img-top" alt="Menu 3" />
              <div class="card-body">
                <h5 class="card-title">Rocket Ramen</h5>
                <p class="card-text">Special dish from canteen-c.</p>
                <p class="text-danger fw-bold">Rp 20,000</p>
                <p class="text-muted">Stock: <span id="stock-3">8</span></p>
                <button class="btn btn-outline-danger btn-sm add-to-cart" data-id="3">Add to Cart</button>
              </div>
            </div>
          </div>
          <div class="col menu-item" data-cafetaria="A">
            <div class="card">
              <img src="images/dimsumigga.jpeg" class="card-img-top" alt="Menu 4" />
              <div class="card-body">
                <h5 class="card-title">Dimsum</h5>
                <p class="card-text">Best snack from canteen-a.</p>
                <p class="text-danger fw-bold">Rp 8,000</p>
                <p class="text-muted">Stock: <span id="stock-4"></span></p>
                <a class="btn btn-outline-danger btn-sm add-to-cart" data-id="4">Add to Cart</a>
              </div>
            </div>
          </div>
          <div class="col menu-item" data-cafetaria="D">
            <div class="card">
              <img src="images/brigga.jpg" class="card-img-top" alt="Menu 5" />
              <div class="card-body">
                <h5 class="card-title">Bread Sticks</h5>
                <p class="card-text">Budget snack from canteen-d</p>
                <p class="text-danger fw-bold">Rp 5,000</p>
                <p class="text-muted">Stock: <span id="stock-5"></span></p>
                <a class="btn btn-outline-danger btn-sm add-to-cart" data-id="5">Add to Cart</a>
              </div>
            </div>
          </div>
          <div class="col menu-item" data-cafetaria="D">
            <div class="card">
              <img src="images/pizzagga.jpg" class="card-img-top" alt="Menu " />
              <div class="card-body">
                <h5 class="card-title">Premium Pizza</h5>
                <p class="card-text">Best meal from canteen-c.</p>
                <p class="text-danger fw-bold">Rp 85,000</p>
                <p class="text-muted">Stock: <span id="stock-6"></span></p>
                <a class="btn btn-outline-danger btn-sm add-to-cart" data-id="6">Add to Cart</a>
              </div>
            </div>
          </div>
        </div>

        <!-- How To Buy Section -->
        <div class="mb-5 mt-2 bg-light" id="HowToBuy">
          <h1 class="display-5 fw-bold text-center">How To Buy</h1>

          <div class="row mt-4 p-6 py-4 px-4">
            <div class="col-md-6">
              <h3>Your Order</h3>
              <table class="table table-bordered">
                <thead class="table-danger">
                  <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="cart-items">
                  <!-- Cart items will be added here dynamically -->
                </tbody>
                <tr class="table-secondary">
                  <td colspan="3" class="text-end fw-bold">Grand Total:</td>
                  <td colspan="2" class="fw-bold" id="grand-total">Rp 0</td>
                </tr>
              </table>
              <button class="btn btn-danger w-100 mt-2" id="checkout-btn" data-bs-toggle="modal" data-bs-target="#paymentModal" disabled>Checkout</button>
            </div>

            <div class="col-md-6">
              <h3>Order Instructions</h3>
              <div class="alert alert-info">
                <ol>
                  <li>Select items from our Cafetaria List</li>
                  <li>Items will appear in your order list</li>
                  <li>Adjust quantities if needed</li>
                  <li>Click Checkout when ready</li>
                  <li>Pay using the generated QR code</li>
                </ol>
              </div>
              <div class="card">
                <div class="card-header bg-danger text-white">Cafetaria Selection</div>
                <div class="card-body">
                  <select class="form-select mb-3" id="cafetaria-select">
                    <option value="all">All Cafeterias</option>
                    <option value="A">Cafetaria A</option>
                    <option value="B">Cafetaria B</option>
                    <option value="C">Cafetaria C</option>
                    <option value="D">Cafetaria D</option>
                  </select>
                  <p class="text-muted">Filter menus by cafetaria</p>

                  <!-- Canteen Images (Hidden by Default) -->
                  <div id="canteen-images" class="mt-3">
                    <img src="images/k1gga.webp" class="img-fluid rounded mb-2 canteen-img" id="canteen-A" style="display: none" alt="Cafetaria A" />
                    <img src="images/k2gga.jpg" class="img-fluid rounded mb-2 canteen-img" id="canteen-B" style="display: none" alt="Cafetaria B" />
                    <img src="images/cafeteria-self-adhesive-kitchen-wallpaper-in-green-color-247373.webp" class="img-fluid rounded mb-2 canteen-img" id="canteen-C" style="display: none" alt="Cafetaria C" />
                    <img src="images/k4.jpg" class="img-fluid rounded mb-2 canteen-img" id="canteen-D" style="display: none" alt="Cafetaria D" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Contact Us Section -->
        <div class="p-4 mb-4 bg-light rounded-3" id="Contact">
          <div class="container-fluid py-4">
            <h1 class="display-5 fw-bold text-center">Contact Us</h1>
            <div class="row mt-4">
              <div class="col-md-6">
                <form action="process_form.php" method="POST">
                  <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required />
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required />
                  </div>
                  <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                  </div>
                  <button type="submit" class="btn btn-danger">Send Message</button>
                </form>
              </div>
              <div class="col-md-6">
                <div class="card h-100">
                  <div class="card-body">
                    <h5 class="card-title">Our Location</h5>
                    <p class="card-text">123 Kantin Street<br />Food District<br />City, 12345</p>
                    <hr />
                    <h5 class="card-title">Opening Hours</h5>
                    <p class="card-text">Monday-Friday: 8AM-5PM<br />Saturday: 9AM-3PM<br />Sunday: Closed</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Video Modal -->
        <div class="modal fade" id="vidModal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="vidModalLabel">Our Kantin Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body ratio ratio-16x9">
                <iframe src="https://www.youtube.com/embed/3AWQnv6g9sk"> </iframe>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Payment Modal -->
        <div class="modal fade" id="paymentModal" aria-labelledby="paymentModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body text-center">
                <h4>Total Amount: <span id="payment-amount">Rp 0</span></h4>
                <p>Scan this QR code to pay</p>
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=KantinPayment-12345" class="img-fluid mb-3" alt="QR Code" />
                <div class="alert alert-success">
                  <p class="mb-0">Your order will be ready in 15 minutes!</p>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="confirm-payment">Payment Completed</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <footer class="pt-3 mt-4 text-muted border-top text-center">2023 Kantin Website. All rights reserved.</footer>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        // Initialize menu items with stock data
        const menuItems = {
          1: { name: "Menu 1", price: 15000, stock: 100, initialStock: 10 },
          2: { name: "Menu 2", price: 6000, stock: 15, initialStock: 15 },
          3: { name: "Menu 3", price: 20000, stock: 8, initialStock: 8 },
          4: { name: "Menu 4", price: 8000, stock: 20, initialStock: 20 },
          5: { name: "Menu 5", price: 5000, stock: 20, initialStock: 20 },
          6: { name: "Menu 6", price: 85000, stock: 5, initialStock: 5 },
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
            addButton.classList.toggle("disabled", menuItems[id].stock <= 0);
          }
        }

        initializeStockDisplay();

        // Add to Cart functionality
        document.querySelectorAll(".add-to-cart").forEach((button) => {
          button.addEventListener("click", function () {
            const id = this.getAttribute("data-id");
            const itemData = menuItems[id];

            const existingItem = cart.find((item) => item.id === id);

            if (existingItem) {
              if (existingItem.quantity < itemData.initialStock) {
                existingItem.quantity++;
                existingItem.total = existingItem.quantity * itemData.price;
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
              canteenImg.style.display = "";
            }
          }

          // Filter menu items
          menuItems.forEach((item) => {
            const cafetaria = item.getAttribute("data-cafetaria");

            if (selectedCafetaria === "all" || cafetaria === selectedCafetaria) {
              item.classList.remove("hidden");
            }
          });
        });
      });
    </script>
  </body>
</html>
