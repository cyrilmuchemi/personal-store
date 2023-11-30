<?php
    if(!empty($_POST))
    {
        $errors = [];

        $query = "select id from users where email = :email limit 1";
        $email = query($query, ['email' => $_POST['email']]);

        if(empty($_POST['email']))
        {
            $errors['email'] = "Please enter your email address!";
        }else
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            $errors['email'] = "Your email is invalid!";
        }else
        if(!$email)
        {
            $errors['email'] = "Your email is not registered. Sign Up!";
        }

        if(empty($errors))
        {
          $new_query = "SELECT username, email, verify_token, verify_status FROM users WHERE email = :email LIMIT 1";
          $rows = query($new_query, ['email' => $_POST['email']]);

          if (!empty($rows)) {
            $row = $rows[0];
            if ($row['verify_status'] === 0) {
                $name = $row['username'];
                $email = $row['email'];
                $verify_token = $row['verify_token'];
        
                resend_email_verify($name, $email, $verify_token);
        
                $_SESSION['status'] = "Reset link has been sent to your email";
            } else {
                $_SESSION['status'] = "Your email address is already verified";
                redirect('login');
            }
          } else {

            $_SESSION['status'] = "Email not found in the database";
          }

    
        }
    }

?>
<?php
    include '../app/pages/includes/head.php';
?>
<div class="container">
  <div class="row">
    <div class="alert alert-success col-md-12" role="alert" id="notes">
      <h4>NOTES</h4>
      <ul>
        <li>You will recieve a verification link on your mail after entering it in the input below. Enter your email below.</li>
      </ul>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-md-12">
      <div class="jumbotron">
        <h2>Enter your email address</h2>
          <?php if(isset($_SESSION['status'])):?>
              <div class="alert alert-success text-center" role="alert">
                  <?php 
                    echo "</p>".$_SESSION['status']."</p>";
                    unset($_SESSION['status']);
                  ?>
              </div>       
          <?php endif;?>
          <?php if(!empty($errors)):?>
              <div class="alert alert-danger text-center" role="alert">
                  <?php 
                    echo "</p>".$errors['email']."</p>";
                  ?>
              </div>       
          <?php endif;?>
        <form method="post" role="form" class="mt-5">
          <div class="col-md-9 col-sm-12">
            <div class="form-group form-group-lg">
              <input type="email" class="form-control col-md-6 col-sm-6 col-sm-offset-2" name="email" required>
              <input class="btn btn-primary btn-lg col-md-2 col-sm-2" type="submit">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="<?=ROOT?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
<?php
    include '../app/pages/includes/bottomnav.php';
?>
</html>