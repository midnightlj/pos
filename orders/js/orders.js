// Close Modal
function closeModal(modalId) {
    $('#' + modalId).removeClass('w3-show');
    $('#order-list').DataTable().ajax.reload();
  }

  $('#edit-order-modal').on('hidden.bs.modal', function (e) {
    $('#order-list').DataTable().ajax.reload();
  })
// Edit Order
function editOrder(order_id, trx_number, amount_paid, discount) {
    console.log('order_id:', order_id);
    console.log('trx_number:', trx_number);
    console.log('amount_paid:', amount_paid);
    console.log('discount:', discount);

    // Check if trx_number already exists
    $.ajax({
      type: 'POST',
      url: 'check_trx_number.php',
      data: { 'trx_number': trx_number },
      success: function(response) {
        console.log(response);
        if (response === 'trx_exists') {
          // If trx_number exists and is the same, update amount_paid only
          $.ajax({
            type: 'POST',
            url: 'edit_order.php',
            data: {
              'order_id': order_id,
              'trx_number': trx_number,
              'amount_paid': amount_paid,
              'discount': discount
            },
            success: function(response) {
              console.log(response);
              if (response === 'success') {
                alert('Order updated successfully');
                closeModal('edit-order-modal');
                // Reload DataTable
                $('#order-list').DataTable().ajax.reload();
              } else {
                alert('Error updating order');
              }
            },
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
              alert('Error updating order');
            }
          });
        } else if (response === 'not_exists') {
          // If trx_number does not exist, update both trx_number and amount_paid
          var row = $('#order-list').DataTable().row('#' + order_id).data();
          var total_price = row.total_price;

          $.ajax({
            type: 'POST',
            url: 'edit_order.php',
            data: {
              'order_id': order_id,
              'trx_number': trx_number,
              'amount_paid': amount_paid,
              'total_price': total_price,
              'discount': discount
            },
            success: function(response) {
              console.log(response);
              if (response === 'success') {
                alert('Order updated successfully');
                closeModal('edit-order-modal');
                // Reload DataTable
                $('#order-list').DataTable().ajax.reload();
              } else {
                alert('Error updating order');
              }
            },
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
              alert('Error updating order');
            }
          });
        } else {
          // If trx_number exists and is not the same, show an error message
          alert('TRX Number already exists!');
        }
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
        alert('Error checking TRX Number');
      }
    });
  }




$(document).ready(function() {
console.log('orders.js loaded in document.ready');

$('#edit-order-modal').on('click', '.decrease-btn', function() {
    console.log('decrease-btn clicked!');
    var buttonId = $(this).attr('id');
    var rowId = buttonId.split('-')[2];
    var skuCode = buttonId.split('-')[3];

    // Find the quantity cell in the current row
    var quantityCell = $(this).closest('tr').find('td:eq(1)');

    // Get the current quantity value
    var currentQuantity = parseInt(quantityCell.text());

    // Check if the current quantity is already 0
    if (currentQuantity === 0) {
      // Alert the user that the quantity cannot be decreased further
      alert('Quantity cannot be decreased further.');
      return;
    }

    // Decrease the quantity value and update the cell
    var newQuantity = currentQuantity - 1;
    quantityCell.text(newQuantity);

    // Update the quantity value in the database and update order details and total price
    $.ajax({
        url: 'update_quantity.php',
        type: 'POST',
        data: {
        row_id: rowId,
        sku_code: skuCode,
        new_quantity: newQuantity
        },
        success: function(response) {
            // console.log(typeof response);
            // console.log(response);

            var parsedResponse = JSON.parse(response);
             var updatedOrderDetailsHtml = parsedResponse.order_details_html;

            // Update the order details table
            $('#order-details-table').html(updatedOrderDetailsHtml);

            // console.log(parsedResponse.new_total_price);

            // Update the total price
            var newTotalPrice = parseFloat(parsedResponse.new_total_price);
            var formattedTotalPrice = 'P' + newTotalPrice.toFixed(2);
            $('.total-price-cell').text(formattedTotalPrice);
            // console.log(parsedResponse);

        },
        error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
        }
    });
  });

  $('#edit-order-modal').on('click', '.increase-btn', function() {
    console.log('increase-btn clicked!');
    var buttonId = $(this).attr('id');
    var rowId = buttonId.split('-')[2];
    var skuCode = buttonId.split('-')[3];

    // Find the quantity cell in the current row
    var quantityCell = $(this).closest('tr').find('td:eq(1)');

    // Get the current quantity value
    var currentQuantity = parseInt(quantityCell.text());

    // Increase the quantity value and update the cell
    var newQuantity = currentQuantity + 1;
    quantityCell.text(newQuantity);

    // Update the quantity value in the database
    $.ajax({
        url: 'update_quantity.php',
        type: 'POST',
        data: {
          row_id: rowId,
          sku_code: skuCode,
          new_quantity: newQuantity
        },
        success: function(response) {
            // console.log(typeof response);
            // console.log(response);

            var parsedResponse = JSON.parse(response);
             var updatedOrderDetailsHtml = parsedResponse.order_details_html;

            // Update the order details table
            $('#order-details-table').html(updatedOrderDetailsHtml);

            console.log(parsedResponse.new_total_price);

            // Update the total price
            var newTotalPrice = parseFloat(parsedResponse.new_total_price);
            var formattedTotalPrice = 'P' + newTotalPrice.toFixed(2);
            $('.total-price-cell').text(formattedTotalPrice);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
      });
  });

  $('#edit-order-modal').on('hidden.bs.modal', function () {
    // Update the total price
    var newTotalDiscount = parseFloat(parsedResponse.discount);
    var formattedDiscount = newTotalDiscount.toFixed(2);
    // data.discount(formattedDiscount);
    console.log(data.discount);
});

    // Destroy existing DataTable (if it exists)
    if ($.fn.DataTable.isDataTable('#order-list')) {
        $('#order-list').DataTable().destroy();
    }

    // Initialize DataTable
    var table = $('#order-list').DataTable({
        'ajax': 'get_order.php',
        'columns': [
            {'data': 'id'},
            {'data': 'trx_number'},
            {'data': 'first_name'},
            {'data': 'name'},
            {'data': 'formatted_date_created'},
            {'data': 'total_price'},
            {'data': 'amount_paid'},
            {'data': 'discount'},
            {'data': 'status'},
            {
                'data': null,
                'render': function(data, type, row, meta) {
                    return '<button class="edit-order-button w3-button w3-teal w3-white w3-border w3-border-teal" data-order-id="' + row.id + '">Update</button>';
                }
            }
        ],
        'rowId': 'id',
        'rowCallback': function(row, data) {
            row.id = data.id;
        },
        'error': function(xhr, error, thrown) {
            console.log('DataTables error:', error, thrown);
        },
        'buttons': [
            'excelHtml5'
        ],
        'columnDefs': [
            {
                'targets': [7], // index of the "discount" column
                'render': function (data, type, row) {
                    return data;
                }
            }
        ],
        'initComplete': function(settings, json) {
            // console.log('initComplete called');
        }
    });

    // Add an event listener to the edit-order-button
    $(document).on('click', '.edit-order-button', function() {
        var order_id = $(this).data('order-id');
        var row = $(this).closest('tr');
        // var trx_number = row.find('.trx-number').text();
        // var amount_paid = row.find('.amount-paid').text();
        var total_price = row.find('.total-price').text();
        var discount = row.find('.discount').text();

        $('#edit-order-form').attr('data-order-id', order_id);

        // Set the value of the total_price and discount inputs
        $('#total_price').val(total_price);
        $('#discount').val(discount);

        // Make an AJAX call to fetch order details
  $.ajax({
    url: "order_details.php",
    type: "POST",
    data: { order_id: order_id },
    dataType: "json",
    success: function(data) {
      // Populate the order details table with fetched data
      $("#order-details tbody").html(data.order_details_html);
      console.log(data.data_details.trx_number);

      // Set the order ID in the hidden input field
      $("#edit-order-form input[name='order_id']").val(order_id);
      $('#total_price').val(data.total_price);
      $('#discount').val(data.discount);

      // Set the value from JSON data.data_details
      $('#trx_number').val(data.data_details.trx_number);
      $('#amount_paid').val(data.data_details.amount_paid);


      // Open the modal
      $('#edit-order-modal').addClass('w3-show');
    },
    error: function() {
      alert("Error fetching order details.");
    }
  })
});
    // Add an event listener to the edit-order-form
    $('#edit-order-form').on('submit', function(e) {
        e.preventDefault();

        var order_id = $(this).data('order-id');
        var trx_number = $('#trx_number').val();
        var amount_paid = $('#amount_paid').val();

        editOrder(order_id, trx_number, amount_paid);
    });

});
