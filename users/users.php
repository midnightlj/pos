<?php
include('../session.php');
include('../partials/header.php');
include('../nav.php');
include('../partials/container.php');
?>

<div class="w3-container w3-padding">
  <h1>User List</h1>
  <button class="w3-button w3-indigo" onclick="openModal('add-user-modal')">Add User</button>
  <div class="w3-responsive">
    <div id="excel-buttons"></div>
    <table id="user-list" class="w3-table w3-striped w3-bordered">
      <thead>
        <tr class="w3-light-grey">
          <th>First Name</th>
          <th>Last Name</th>
          <th>User Name</th>
          <th>User Access</th>
          <th>User Code</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <!-- <div id="edit-user-modal" class="w3-modal">
  <div class="w3-modal-content w3-animate-top w3-card-4">
    <header class="w3-container w3-indigo">
      <span onclick="closeModal('edit-user-modal')" class="w3-button w3-display-topright">&times;</span>
      <h2>Edit User</h2>
    </header>
    <form id="edit-user-form" class="w3-container">
      <input type="hidden" name="user_id">
      
      <div class="w3-container w3-padding">
        <label class="w3-text-indigo"><b>First Name</b></label>
        <input class="w3-input w3-border" type="text" id="first_name" name="first_name" required>
      </div>

      <div class="w3-container w3-padding">
        <label class="w3-text-indigo"><b>Last Name</b></label>
        <input class="w3-input w3-border" type="text" id="last_name" name="last_name" required>
      </div>

      <div class="w3-container w3-padding">
        <label class="w3-text-indigo"><b>User Name</b></label>
        <input class="w3-input w3-border" type="text" id="user_name" name="user_name" required>
      </div>

      <div class="w3-container w3-padding">
        <label class="w3-text-indigo"><b>Password</b></label>
        <input class="w3-input w3-border" type="password" id="user_password" name="user_password" required>
      </div>

      <div class="w3-container w3-padding">
        <label class="w3-text-indigo"><b>User Access</b></label>
        <input class="w3-input w3-border" type="text" id="user_access" name="user_access" required>
      </div>

      
      <div class="w3-container w3-padding-16">
        <button class="w3-button w3-green w3-right" type="submit">Save Changes</button>
        <button onclick="closeModal('edit-user-modal')" type="button" class="w3-button w3-red w3-right w3-margin-right">Cancel</button>
      </div>
    </form>
  </div>
</div> -->

<!-- Add user modal -->
<div id="add-user-modal" class="w3-modal">
  <div class="w3-modal-content">
    <header class="w3-container w3-indigo">
      <span onclick="closeModal('add-user-modal')" class="w3-button w3-display-topright">&times;</span>
      <h2>Add User</h2>
    </header>
    <div class="w3-container">
      <form id="add-user-form">
        <label for="first-name">First Name:</label>
        <input type="text" id="first-name" name="first_name" required>
        <label for="last-name">Last Name:</label>
        <input type="text" id="last-name" name="last_name" required>
        <label for="user-name">User Name:</label>
        <input type="text" id="user-name" name="user_name" required>
        <label for="user-name">Password:</label>
        <input type="text" id="user-password" name="user_password" required>
        <label for="user-name">User Code:</label>
        <input type="text" id="user-code" name="user_code" required>
        <label for="user-access">User Access:</label>
        <select id="user-access" name="user_access" required>
          <option value="">Select User Access</option>
          <option value="Administrator">Administrator</option>
          <option value="Sales Assistant">Sales Assistant</option>
        </select><br><br>
        <button type="submit" class="w3-button w3-indigo">Add User</button>
      </form>
    </div>
  </div>
</div>
</div>
<script src="js/users.js"></script>
<script src="js/get_access.js"></script>

<?php
include('../partials/footer.php');
?>
