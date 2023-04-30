<?php
include('../session.php');
include('../partials/header.php');
include('../nav.php');
include('../partials/container.php');
?>

<div class="w3-container w3-responsive">
  <br>
  <form class="w3-container w3-card-4">
    <div class="w3-row">
      <div class="w3-col s12 m2">
        <label for="nationality">Nationality:</label>
      </div>
      <div class="w3-col s12 m6 p6">
          <select class="select2-container--custom select2-container--single" id="select-box" name="nationality">
            <!-- options will be added dynamically -->
          </select>
      </div>
    </div>

    <div class="w3-row">
      <div class="w3-col s12 m2">
        <label for="product">Product:</label>
      </div>
      <div class="w3-col s12 m8 p6">
        <input class="w3-input" type="text" id="product" name="product" value="" placeholder="SKU Code" style="margin-right: 16px;" required>
      </div>
      <div class="w3-col s12 m2 p6">
        <button class="w3-button w3-bar w3-teal w3-white w3-border w3-border-teal w3-round-large" id="enterKey" type="button" onclick="addToCart()">Add</button>
      </div>
    </div>

    <div id="cart">
        <h2>Product List</h2>
        <ul class="w3-ul w3-teal" id="cart-items">
        </ul>
      <div class="w3-row">
        <div class="w3-col s12 m6">
          <p>Total Quantity: <span id="cart-total-qty"></span></p>
        </div>
        <div class="w3-col s12 m6">
          <p>Total Price: <span id="cart-total"></span></p>
        </div>
      </div>
    </div>
    <div class="w3-row">
      <div class="w3-col s12 m6 p6">
        <button class="w3-button w3-bar w3-teal w3-white w3-border w3-border-teal w3-round-large" type="button" onclick="checkout()">Checkout</button>
      </div>
      <div class="w3-col s12 m6 p6">
        <button class="w3-button w3-bar w3-teal w3-white w3-border w3-border-teal w3-round-large" type="button" onclick="clearCart()">Clear</button>
      </div>
    </div>
  </form>



</div>

<script src="js/cart.js"></script>
<script src="js/get_nat.js"></script>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<?php
// include('../partials/footer.php');
?>
