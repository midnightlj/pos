// Close Modal
function closeModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = 'none';
}

// Edit Order
function editOrder(order_id, trx_number, amount_paid, total_price, discount) {
    console.log('order_id:', order_id);
    console.log('trx_number:', trx_number);
    console.log('amount_paid:', amount_paid);
    console.log('total_price:', total_price);
    console.log('discount:', discount);

    // Check if trx_number already exists
    $.ajax({
        type: 'POST',
        url: 'check_trx_number.php',
        data: {'trx_number': trx_number},
        success: function(response) {
            console.log(response);
            if (response === 'exists') {
                alert('TRX Number already exists!');
            } else {
                // Get the total price and discount from the row
                var row = $('#order-list').DataTable().row('#' + order_id).data();
                var total_price = row.total_price;

                // Send AJAX request to update order
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
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            alert('Error checking TRX Number');
        }
    });
}

$(document).ready(function() {

    // Destroy existing DataTable (if it exists)
    if ($.fn.DataTable.isDataTable('#order-list')) {
        $('#order-list').DataTable().destroy();
    }

    // Initialize DataTable
    var table = $('#order-list').DataTable({
        'ajax': 'get_today.php',
        'columns': [
            {'data': 'id'},
            {'data': 'trx_number'},
            {'data': 'first_name'},
            {'data': 'name'},
            {'data': 'formatted_date_created'},
            {'data': 'total_price'},
            {'data': 'amount_paid'},
            {'data': 'discount'},
            {'data': 'status'}
            // {
            //     'data': null,
            //     'render': function(data, type, row, meta) {
            //         return '<button class="edit-order-button" data-order-id="' + row.id + '">Update</button>';
            //     }
            // }
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
            // console.log(json);

            // Add Excel export functionality
            $('#order-list').DataTable().buttons().container().appendTo('#excel-buttons');
        }
    });

    var exportButton = new $.fn.dataTable.Buttons(table, {
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Export to Excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            }
        ]
    }).container().appendTo($('#excel-buttons'));

    // Add an event listener to the edit-order-button
    $(document).on('click', '.edit-order-button', function() {
        var order_id = $(this).data('order-id');
        var row = $(this).closest('tr');
        var trx_number = row.find('.trx-number').text();
        var amount_paid = row.find('.amount-paid').text();
        var total_price = row.find('.total-price').text();
        var discount = row.find('.discount').text();

        $('#edit-order-form').attr('data-order-id', order_id);
        $('#trx_number').val(trx_number); // set the value of the trx_number input
        $('#amount_paid').val(amount_paid);

        // Set the value of the total_price and discount inputs
        $('#total_price').val(total_price);
        $('#discount').val(discount);

        $('#edit-order-modal').show(); // show the modal
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
