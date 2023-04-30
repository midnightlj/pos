<?php

include('server.php');
include('partials/header.php');
include('partials/container.php');
error_reporting (E_ALL ^ E_NOTICE);
?>
</head>
            <!-- <div class="container" style="margin-top:150px;padding-left:20px;padding-right:20px;"> -->
<style>
/* .login-form {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.login-form h2 {
  margin-top: 0;
}

.login-form label {
  display: block;
  font-size: 0.8rem;
  margin-bottom: 5px;
}

.login-form input[type="text"],
.login-form input[type="password"] {
  display: block;
  width: 94%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 1rem;
}

.login-form input[type="checkbox"] {
  display: inline-block;
  margin-right: 10px;
}

.login-form button[type="submit"] {
  display: block;
  width: 100%;
  padding: 10px;
  margin-top: 20px;
  border: none;
  border-radius: 5px;
  background-color: #0073aa;
  color: #fff;
  font-size: 1.2rem;
  cursor: pointer;
}

.login-form button[type="submit"]:hover {
  background-color: #005580;
}

.login-form label[for="remember-me"] {
  display: inline-block;
  margin-bottom: 0;
  margin-right: 10px;
  font-size: 0.8rem;
  line-height: 1.5;
} */
.w3-card-4{
  min-width: 300px;
}

.w3-button {
  margin:0 36%;
}

.w3-check {
  width: 20px;
  height: 20px;
}
.w3-animate-fading{
  animation:fading 3s infinite;
}
/* .w3-container h4, p {
  text-align: center;
} */
</style>
<!-- <div class="login-form"> -->
<div class="w3-card-4 w3-display-middle">
  <header class="w3-container w3-teal w3-center">
    <h4>P&C Beauty Managers</h4>
  </header>
  <div class="w3-red w3-center w3-border"><?php include($_SERVER['DOCUMENT_ROOT'].'/errors.php'); ?></div>
    <!-- <form method="POST" action="login.php" id="login-form" class="login-form"> -->
    <form method="POST" action="login.php" id="login-form">
      <div class="w3-container w3-padding-16">
        <!-- <label for="username" class="w3-text-teal" >Username</label> -->
        <input type="text" id="username" name="username" class="w3-input" placeholder="Username" required>
      </div>
      <div class="w3-container w3-padding-16">
        <!-- <label for="password">Password</label> -->
        <input type="password" id="password" name="password" class="w3-input" placeholder="Password" required>
      </div>
      <div class="w3-container">
        <input type="checkbox" id="remember-me" class="w3-check">
        <label for="remember-me" class="w3-text-teal">Remember Me</label>
      </div>
      <div class="w3-container w3-padding-16">
        <button type="submit" name="submit" class="w3-button w3-teal w3-round-large">Login</button>
      </div>
    </form>
    <footer class="w3-container w3-teal w3-center w3-tiny">
      <p>&copy; All rights reserved <?php echo date('Y')?></p>
    </footer>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const loginForm = document.querySelector('#login-form');
  const usernameInput = loginForm.querySelector('#username');
  const passwordInput = loginForm.querySelector('#password');
  const rememberMeCheckbox = loginForm.querySelector('#remember-me');

  // Check if remember me is checked and if so, populate username and password fields
  if (localStorage.getItem('rememberMe') === 'true') {
    rememberMeCheckbox.checked = true;
    usernameInput.value = localStorage.getItem('username');
    passwordInput.value = localStorage.getItem('password');
  }

  // Save username and password to local storage when remember me is checked
  rememberMeCheckbox.addEventListener('change', () => {
    if (rememberMeCheckbox.checked) {
      localStorage.setItem('rememberMe', true);
      localStorage.setItem('username', usernameInput.value);
      localStorage.setItem('password', passwordInput.value);
    } else {
      localStorage.removeItem('rememberMe');
      localStorage.removeItem('username');
      localStorage.removeItem('password');
    }
  });
});
</script>
