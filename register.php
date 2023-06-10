<?php
require('./config.php');

?>

<!doctype html>
<html>

  <head>
    <?php inject_default_page_head('Register'); ?>
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
          <h1>Registration</h1>
        <div>

        <p id='register_notif' class="m-2 p-2 text-danger">        
        <?php if(isset($_SESSION['register_notif'])){
          echo $_SESSION['register_notif'];
        } 
        ?>
        </p>

        <div class='w-100'>
          <form method="post" action ="./php/register_script.php">
            <div class='w-100 p-2'><label>firstname: <input type='text' name='firstname'></label></div>
            <div class='w-100 p-2'><label>lastname: <input type='text' name='lastname'></label></div>
            <div class='w-100 p-2'><label>username: <input type='text' name='username'></label></div>
            <div class='w-100 p-2'><label>password: <input type='password' name='password'></label></div>
            <div class='w-100 p-2'><label>re-enter: <input type='password' name='re-password'></label></div>
            <div class='w-100 p-2'><label>email: <input type='text' name='email'></label></div>

            <div class='w-100 p-2'>
              <input type='submit' class='login-button' value='Submit'>
              <input type="button" class='login-button' value="Return↺" onclick="window.location.href='./login.php'"/>
            </div>
          </form>
        </div>
      </div>
    </div>
    </div>
  </body>
</html>
<?php
unset($_SESSION['register_notif']);
?>
