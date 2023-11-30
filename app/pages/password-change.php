<?php
    if(!empty($_POST))
    {
        $errors = [];

        $query = "select id from users where email = :email limit 1";
        $email = query($query, ['email' => $_POST['email']]);

        if(empty($_POST['email']))
        {
            $errors['email'] = "Please enter your email below!";
        }else
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            $errors['email'] = "Invalid email format!";
        }else
        if(!$email)
        {
            $errors['email'] = "Email does not exist. Sign Up!";
        }

        
        if(empty($_POST['password']))
        {
            $errors['password'] = "Please enter your password!";
        }else
        if(strlen($_POST['password'] < 8))
        {
            $errors['password'] = "Password must be 8 characters or more";
        }else
        if(!preg_match("/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#\$%])[0-9a-zA-Z!@#\$%]+$/", $_POST['password']))
        {
            $errors['password'] = "Password must contain numbers, letters and special characters";
        }else
        if($_POST['password'] !== $_POST['confirmpassword'])
        {
            $errors['password'] = "Passwords do not match!";
        }

        if(empty($errors))
        {
            $mail_query = "select email from users where email = :email limit 1";
            $row = query($mail_query, ['email' => $_POST['email']]);

            if($row)
            {
                $new_password =  password_hash($_POST['password'], PASSWORD_DEFAULT);
                $update_password = "update users set password=:new_password where email = :email";

                try {
                    $success = query($update_password, [':new_password' => $new_password, ':email' => $_POST['email']], true);
                    if ($success) {
                      $_SESSION['status'] = "Your password has been reset successfully.";
                      redirect('login');
    
                    } else {
    
                      $_SESSION['status'] = "Could not send a reset password";
    
                    }
                } catch (PDOException $e) {
    
                    echo "Database error: " . $e->getMessage();
    
                }
            } else
            {
                $_SESSION['status'] = "Oops! Something went wrong";
            }
        }
    }
?>
<?php
     include '../app/pages/includes/head.php';
?>
    <main id="main" class="form-signin">
    <div class="container mt-5">
    <form method="post" role="form">
        <h1 class="h3 mb-3 fw-normal">Reset Your Password</h1>
        <?php if(!empty($errors)):?>
            <div class="alert alert-danger text-center" role="alert">
                Please Fix the Errors Below!
            </div>
        <?php endif;?>
        <?php  if(isset($_SESSION['status'])):?>
            <div class="alert alert-success text-center" role="alert">
                <?php 
                    echo "</p>".$_SESSION['status']."</p>";
                    unset($_SESSION['status']);
                ?>
            </div>
        <?php endif;?>
        <div class="form-floating mt-4">
        <input type="email" class="form-control" name="email" placeholder="name@example.com" value="<?=old_value('email')?>" >
        <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating mt-4">
        <input type="password" class="form-control" name="password" placeholder="Password" value="<?=old_value('password')?>" >
        <label for="floatingPassword">New Password</label>
        </div>
        <div class="form-floating mt-4">
        <input type="password" class="form-control" name="confirmpassword" placeholder="Password" value="<?=old_value('confirmpassword')?>" >
        <label for="floatingPassword">Confirm Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary mb-4 mt-4" type="submit">Change Password</button>
        <?php if(!empty($errors['email'])):?>
            <div class="alert alert-danger text-center" role="alert">
            <?=$errors['email'];?>
            </div>
        <?php endif;?>
        <?php if(!empty($errors['password'])):?>
            <div class="alert alert-danger text-center" role="alert">
            <?=$errors['password'];?>
            </div>
        <?php endif;?>
    </form>
    </div>
    </main>
    <script src="<?=ROOT?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php
    include '../app/pages/includes/bottomnav.php';
    ?>
  </body>
</html>