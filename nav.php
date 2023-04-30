<style>
/* Add a black background color to the top navigation */
.topnav {
  background-color: #333;
  overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Add an active class to highlight the current page */
.active {
  background-color: #009688!important;
  color: white;
}

/* Hide the link that should open and close the topnav on small screens */
.topnav .icon {
  display: none;
}

/* Dropdown container - needed to position the dropdown content */
.dropdown {
  float: left;
  overflow: hidden;
}

/* Style the dropdown button to fit inside the topnav */
.dropdown .dropbtn {
  font-size: 17px;
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

/* Style the dropdown content (hidden by default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Style the links inside the dropdown */
.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

/* Add a dark background on topnav links and the dropdown button on hover */
.topnav a:hover, .dropdown:hover .dropbtn {
  background-color: #009688!important;
  color: white;
}

/* Add a grey background to dropdown links on hover */
.dropdown-content a:hover {
  background-color: #009688!important;
  color: rgb(255,255,255);
}

/* Show the dropdown menu when the user moves the mouse over the dropdown button */
.dropdown:hover .dropdown-content {
  display: block;
}

/* When the screen is less than 600 pixels wide, hide all links, except for the first one ("Home"). Show the link that contains should open and close the topnav (.icon) */
@media screen and (max-width: 600px) {
  .topnav a:not(:first-child), .dropdown .dropbtn {
    display: none;
  }
  .topnav a.icon {
    float: right;
    display: block;
  }
}

/* The "responsive" class is added to the topnav with JavaScript when the user clicks on the icon. This class makes the topnav look good on small screens (display the links vertically instead of horizontally) */
@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive a.icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
  .topnav.responsive .dropdown {float: none;}
  .topnav.responsive .dropdown-content {position: relative;}
  .topnav.responsive .dropdown .dropbtn {
    display: block;
    width: 100%;
    text-align: left;
  }
}

/* Style inputs, select elements and textareas */
input[type=text], select, textarea{
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  resize: vertical;
}

/* Style the label to display next to the inputs */
label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

/* Style the submit button */
input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

/* Style the container */
.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

/* Floating column for labels: 25% width */
.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

/* Floating column for inputs: 75% width */
.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}

.w3-white {
  color: #009688!important;
}

.w3-white:hover{
  color: #fff !important;
  background-color: #009688!important;
}

.p6 {
  padding:6px;
}

.select2-container--custom .select2-selection--single {
  padding: 8px;
  border: none;
  border-bottom: 1px solid #ccc;
  width: 100%;
  height: auto;
}

@media (max-width: 768px) {
  .select2-container--custom .select2-selection--single {
    width: 200px;
  }
}

/* Set the width of the Select2 dropdown to 300 pixels on larger screens */
@media (min-width: 769px) {
  .select2-container--custom .select2-selection--single {
    width: 300px;
  }
}
</style>
<script>
/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

</script>
<?php

// User Access
if ($user_access != "Administrator") {
  $display = "display:none;";
} else {
  $display = "";
}
?>

<div class="topnav" id="myTopnav">
  <a href="../index.php" class="active">Home</a>
  <!-- <a href="#contact">Maintenance</a> -->
  <div class="dropdown">
    <button class="dropbtn" style="<?php echo $display;?>">Maintenance
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content" style="<?php echo $display;?>">
      <a href="../users/users.php" style="<?php echo $display;?>">User</a>
      <a href="../items/items.php" style="<?php echo $display;?>">Product</a>
      <a href="#" style="<?php echo $display;?>">Nationality</a>
      <!-- <a href="#"></a> -->
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Sales Order
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="../orders/add_order.php">Transact Order</a>
      <a href="../orders/orders.php">Order Details</a>
      <!-- <a href="#">Link 3</a> -->
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Sales Orders Status
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="../orders/pending.php">Pending</a>
      <a href="../orders/completed.php">Completed</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn" style="<?php echo $display;?>">Sales Orders Report
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="../orders/today.php" style="<?php echo $display;?>">Today</a>
      <a href="../orders/last_seven.php" style="<?php echo $display;?>">Last 7 Days</a>
      <a href="../orders/this_month.php" style="<?php echo $display;?>">This Month</a>
      <a href="../orders/all_orders.php" style="<?php echo $display;?>">All Orders</a>
    </div>
  </div>
  <a href="../index.php?logout=exit">Logout</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
</div>
