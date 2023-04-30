<?php
include('../session.php');
include('../partials/header.php');
include('../nav.php');
include('../partials/container.php');
?>

<div class="w3-container w3-padding">
  <h1>Item List</h1>
  <button class="w3-button w3-indigo" onclick="openModal('add-item-modal')">Add Item</button>
  <button class="w3-button w3-indigo" onclick="openModal('add-item-modal')">Bulk Upload</button>
  <div class="w3-responsive">
    <div id="excel-buttons"></div>
    <table id="item-list" class="w3-table w3-striped w3-bordered">
      <thead>
        <tr class="w3-light-grey">
          <th>SKU Code</th>
          <th>Item Name</th>
          <th>Item Price</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>

<!-- Add item modal -->
<div id="add-item-modal" class="w3-modal">
  <div class="w3-modal-content">
    <header class="w3-container w3-indigo">
      <span onclick="closeModal('add-item-modal')" class="w3-button w3-display-topright">&times;</span>
      <h2>Add Item</h2>
    </header>
    <div class="w3-container">
      <form id="add-item-form">
        <label for="sku-code">SKU Code:</label>
        <input type="text" id="sku-code" name="sku_code" required>
        <label for="item-name">Item Name:</label>
        <input type="text" id="item-name" name="item_name" required>
        <label for="item-price">Item Price:</label>
        <input type="text" id="item-price" name="item_price" required>
        <button type="submit" class="w3-button w3-indigo">Add Item</button>
      </form>
    </div>
  </div>
</div>
</div>
<script src="js/items.js"></script>

<?php
include('../partials/footer.php');
?>
