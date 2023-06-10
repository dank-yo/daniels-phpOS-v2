<?php
require('config.php');

?>

<!doctype html>
<html>

  <head>
    <?php inject_default_page_head('Login'); ?>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var loginNotf = document.getElementById('login_notif');
        if (loginNotf && loginNotf.textContent.trim().startsWith('Success')) {
          loginNotf.classList.add('text-success');
        } else if (loginNotf && loginNotf.textContent.trim().startsWith('Error')) {
          loginNotf.classList.add('text-danger');
        }
      });
    </script>
  </head>

  <body>
    <div class="container container-center">
      <div class="login-pane">
        <div class='m-2 p-2'>
          <h1>Login</h1>
        <div>

        <p id="login_notif" class="m-2 p-2">
        <?php if(isset($_SESSION['login_notif'])){
          echo $_SESSION['login_notif'];
        } 
        ?>
        </p>

        <div class='w-100'>
          <form method="post" action ="./php/login_script.php">
              <div class='w-100 p-2'><label>email: <input type='text' name='email'></label></div>
              <div class='w-100 p-2'><label>password: <input type='password' name='password'></label></div>
              <div class='w-100 p-2'>
                <input type='submit' value='Login' class='login-button'>
                <input type="button" class='login-button' value="Register" onclick="window.location.href='./register.php'"/>
              </div>
          </form>
        </div>
      </div>
    </div>
    </div>
  </body>

</html>
<?php
unset($_SESSION['login_notif']);
?>