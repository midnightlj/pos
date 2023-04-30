<?php
include('../session.php');
include('../partials/header.php');
include('../nav.php');
include('../partials/container.php');
?>

<div class="w3-container w3-padding">
  <h1>Sales Order List</h1>
  <div class="w3-responsive">
    <div id="excel-buttons"></div>
    <table id="order-list" class="w3-table w3-striped w3-bordered">
      <thead>
        <tr class="w3-light-grey">
          <th>SO Number</th>
          <th>TRX Number</th>
          <th>Sales Assistant</th>
          <th>Nationality</th>
          <th>SO Date</th>
          <th>Total Amount</th>
          <th>Amount Paid</th>
          <th>Discounted Amount</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <div id="edit-order-modal" class="w3-modal">
  <div class="w3-modal-content w3-animate-top w3-card-4">
    <header class="w3-container w3-indigo">
      <span onclick="closeModal('edit-order-modal')" class="w3-button w3-display-topright">&times;</span>
      <h2>Edit Order</h2>
    </header>
    <div class="w3-container w3-padding">
      <table id="order-details" class="w3-table w3-striped w3-bordered">
        <thead>
          <tr class="w3-light-grey">
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    <form id="edit-order-form" class="w3-container">
      <input type="hidden" name="order_id">
      <input type="hidden" name="total_price">
      
      <div class="w3-container w3-padding">
        <label class="w3-text-indigo"><b>TRX Number</b></label>
        <input class="w3-input w3-border" type="text" id="trx_number" name="trx_number" required>
      </div>

      <div class="w3-container w3-padding">
        <label class="w3-text-indigo"><b>Amount Paid</b></label>
        <input class="w3-input w3-border" type="number" id="amount_paid" name="amount_paid" required>
      </div>
      
      <div class="w3-container w3-padding-16">
        <button class="w3-button w3-green w3-right" type="submit">Save Changes</button>
        <button onclick="closeModal('edit-order-modal')" type="button" class="w3-button w3-red w3-right w3-margin-right">Cancel</button>
      </div>
    </form>
  </div>
</div>
</div>
<script src="js/orders.js"></script>
<script>
var row = $(this).closest('tr');
var trx_number = row.find('.trx-number').text();
var amount_paid = row.find('.amount-paid').text();
var total_price = row.find('.total-price').text();
var discount = row.find('.discount').text();
</script>

<?php
include('../partials/footer.php');
?>
