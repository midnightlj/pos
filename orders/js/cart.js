// Get the input field
var input = document.getElementById("product");

// Execute a function when the user presses a key on the keyboard
input.addEventListener("keypress", function(event) {
  // If the user presses the "Enter" key on the keyboard
  if (event.key === "Enter") {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("enterKey").click();
  }
});

// Define an empty cart array
let cart = [];

// Get the cart items ul element and cart total span element
const cartItems = document.getElementById('cart-items');
const cartTotal = document.getElementById('cart-total');
const cartTotalQty = document.getElementById('cart-total-qty');



// Function to add product to cart
function addToCart() {
  // Get the product input element and its value
  const productInput = document.getElementById('product');
  const product = productInput.value;

  // Send an AJAX request to the server to check if the product exists
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // If the server returns a response with status 200 (OK),
        // parse the response JSON and check if the product exists
        const response = JSON.parse(xhr.responseText);
        if (response.exists) {
          // If the product exists, check if it is already in the cart
          const existingProduct = cart.find(item => item.sku_code === product);
          // console.log(response);

          if (existingProduct) {
            // If the product is already in the cart, increment its quantity by 1
            existingProduct.quantity++;
          } else {
            // If the product is not in the cart, add it with quantity 1
            cart.push({ sku_code: product, name: response.name, price: response.price, quantity: 1 });
          }
          // Clear the product input element
          productInput.value = '';
          // Display the updated cart items and total
          displayCart();
          // Set Focus
          productInput.focus();
        } else {
          // If the product does not exist, display an error message
          alert('Product not found!');
          // Clear the product input element
          productInput.value = '';
          // Set Focus
          setTimeout(function(){productInput.focus();}, 1);
        }
      } else {
        // If the server returns an error status, display an error message
        alert('Error: Could not check if product exists');
      }
    }
  };
  xhr.open('POST', 'check_product.php');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send(`product=${encodeURIComponent(product)}`);
}

// Function to display the cart items and total
function displayCart() {
  // Clear the cart items ul element
  cartItems.innerHTML = '';
  // Initialize totalPrice
  let totalPrice = 0;
  // Loop through each item in the cart and add it to the cart items ul element
  cart.forEach(item => {
    const li = document.createElement('li');
    li.innerHTML = `${item.name} - ${item.price} <span style="float: right;">x ${item.quantity}</span>`;
    cartItems.appendChild(li);
    totalPrice += item.price * item.quantity;
  });

  // Calculate and display the total price of the cart
  const totalQty = cart.reduce((acc, item) => acc + item.quantity, 0);
  cartTotalQty.textContent = totalQty;
  cartTotal.textContent = `P`+totalPrice.toFixed(2);


}

// Function to clear the cart
function clearCart() {
  cart = [];
  displayCart();
}

// Function to checkout (not implemented in this example)
function checkout() {

  const selectedNat = document.getElementById('select-box').value;

    // Check if the cart is empty
    if (Object.keys(cart).length === 0) {
      alert('Product List is empty');
      return;
    }

     // Check if a nationality is selected
    const nationalitySelect = document.getElementById('select-box');
    const selectedNationality = nationalitySelect.value;
    if (!selectedNationality) {
      alert('Please select a nationality');
      return;
    }
  
  // Send an AJAX request to the server to save the cart data
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // If the server returns a response with status 200 (OK),
        // display a success message and clear the cart
        alert('Checkout successful!');
        clearCart();
        document.getElementById('select-box').value = '';
      } else {
        // If the server returns an error status, display an error message
        alert('Error: Could not save cart data');
      }
    }
  };

  // Create an object that contains the cart data and the selected nationality
  const data = {
    cart: cart,
    nationality: selectedNationality
  };


  xhr.open('POST', 'save_cart.php');
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.send(JSON.stringify({cart: cart, nationality: selectedNationality}));
}
