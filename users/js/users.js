function openModal(id) {
  var modal = document.getElementById(id);
  modal.style.display = "block";
}

function closeModal(id) {
  var modal = document.getElementById(id);
  modal.style.display = "none";
}

$(document).ready(function() {
  setTimeout(function() {
    table.ajax.reload();
  }, 1000);

  var table = $('#user-list').DataTable({
    'ajax': {url:'get_users.php', dataSrc:''},
    'columns': [
      {'data': 'first_name'},
      {'data': 'last_name'},
      {'data': 'user_name'},
      {'data': 'user_access'},
      {'data': 'user_code'},
      {
        'data': null,
        'render': function(data, type, row) {
          return '<button class="w3-button w3-blue w3-round edit-user" data-id="' + row.user_id + '">Edit</button>' +
          '<button class="w3-button w3-red w3-round delete-user" data-id="' + row.user_id + '">Delete</button>';
        }
      }
    ],
    'error': function(xhr, error, thrown) {
      console.log(xhr);
      console.log(error);
      console.log(thrown);
    }
  });

 // Function for adding a user
$('#add-user-form').submit(function(event) {
  event.preventDefault();

  // Get the values for the new user from the form
  var first_name = $('#add-user-form #first-name').val();
  var last_name = $('#add-user-form #last-name').val();
  var user_name = $('#add-user-form #user-name').val();
  var user_password = $('#add-user-form #user-password').val();
  var user_access = $('#add-user-form #user-access').val();
  var user_code = $('#add-user-form #user-code').val();

  // Send the AJAX request to check if the username and usercode already exists
  $.ajax({
    url: 'check_user_name.php',
    type: 'POST',
    data: {user_name: user_name},
    dataType: 'json',
    success: function(name_response) {
      if (name_response.success) {
        // Username is available, check for user code
        $.ajax({
          url: 'check_user_code.php',
          type: 'POST',
          data: {user_code: user_code},
          dataType: 'json',
          success: function(code_response) {
            if (code_response.success) {
              // User code is available, add the user
              $.ajax({
                url: 'add_user.php',
                type: 'POST',
                data: $('#add-user-form').serialize(),
                success: function(response) {
                  $('#add-user-modal').removeClass('w3-show');
                  $('#add-user-form')[0].reset();
                  closeModal('add-user-modal');
                  // Reload the data in the table
                  $('#user-list').DataTable().ajax.reload();
                  alert('User added successfully');
                },
                error: function(xhr, status, error) {
                  console.log(xhr);
                  console.log(status);
                  console.log(error);
                  alert('An error occurred while adding the user. Please try again later.');
                }
              });
            } else {
              // User code already exists, show error message
              alert(code_response.message);
            }
          },
          error: function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
            alert('An error occurred while checking the user code. Please try again later.');
          }
        });
      } else {
        // Username already exists, show error message
        alert(name_response.message);
      }
    },
    error: function(xhr, status, error) {
      console.log(xhr);
      console.log(status);
      console.log(error);
      alert('An error occurred while checking the username. Please try again later.');
    }
  });
});



  // Function for editing a user
  $(document).on('click', '.edit-user', function() {
    var user_id = $(this).data('id');
    $.ajax({
      url: 'get_user.php',
      type: 'POST',
      data: {'user_id': user_id},
      dataType: 'json',
      success: function(response) {
        $('#edit-user-modal input[name="user_id"]').val(response.user_id);
        $('#edit-user-modal input[name="first_name"]').val(response.first_name);
        $('#edit-user-modal input[name="last_name"]').val(response.last_name);
        $('#edit-user-modal input[name="user_name"]').val(response.user_name);
        $('#edit-user-modal input[name="user_password"]').val(response.user_password);
        $('#edit-user-modal input[name="user_access"]').val(response.user_access);
        $('#edit-user-modal').addClass('w3-show');
      },
      error: function(xhr, status, error) {
        console.log(xhr);
        console.log(status);
        console.log(error);
      }
    });
  });

  $('#edit-user-form').submit(function(event) {
    event.preventDefault();
    $.ajax({
      url: 'edit_user.php',
      type: 'POST',
      data: $(this).serialize(),
      success: function(response) {
        $('#edit-user-modal').removeClass('w3-show');
        $('#edit-user-form')[0].reset();
        table.ajax.reload();
        alert('User updated successfully');
      },
      error: function(xhr, status, error) {
        console.log(xhr);
        console.log(status);
        console.log(error);
      }
    });
  });

});