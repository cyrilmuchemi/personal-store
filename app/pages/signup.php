<?php
    if(!empty($_POST))
    {
        //validate signup
        $errors = [];


        $query = "select id from users where username = :username limit 1";
        $username = query($query, ['username' => $_POST['username']]);

        if(empty($_POST['username']))
        {
            $errors['username'] = "Please enter your username!";

        }else
        if(!preg_match("/^[0-9a-zA-Z]{2,23}+$/", $_POST['username']))
        {
            $errors['username'] = "Username can only contain numbers and letters!";
        }else
        if($username)
        {
            $errors['username'] = "Username already exists";
        }

        $query = "select id from users where email = :email limit 1";
        $email = query($query, ['email' => $_POST['email']]);

        if(empty($_POST['email']))
        {
            $errors['email'] = "Please enter your email!";
        }else
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
          $errors['email'] = "Email not valid";
        }else
        if($email)
        {
            $errors['email'] = "That email already exists";
        }

        $query = "select id from users where phone = :phone limit 1";
        $phone = query($query, ['phone' => $_POST['phone']]);

        if(empty($_POST['phone']))
        {
            $errors['phone'] = "Please enter your phone number!";
        }else
        if($phone)
        {
            $errors['phone'] = "That phone number is in use!";
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

        if(empty($_POST['terms']))
        {
            $errors['terms'] = "Accept terms before proceeding";
        }


        if(empty($errors))
        {
            $_POST['user_id'] = create_user_id();
            $user_query = 'select id from users where user_id = :user_id limit 1';
            $user_id = query($user_query, ['user_id' => $_POST['user_id']]);

            $data = [];
            $data['username'] = $_POST['username'];
            $data['email'] = $_POST['email'];
            $data['phone'] = $_POST['phone'];
            $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $data['verify_token'] = md5(rand());
            $data['role'] = "customer";

            if(!$user_id)
            {
                $data['user_id'] = $_POST['user_id'];
            }
            
            $query = "insert into users (username, email, phone, password, verify_token, role, user_id) values (:username, :email, :phone, :password, :verify_token, :role, :user_id)";
            query($query, $data);

            sendemail_verify($data['username'], $data['email'], $data['verify_token']);
            $_SESSION['status'] = "Registration Successful! Please verify your email";
        }
    }
?>
     <?php
        include '../app/pages/includes/head.php';
    ?>
    <?php
        include '../app/pages/includes/header.php';
    ?>
    <main id="main" class="login-page">
        <div class="container">
            <div class="login-box d-flex my-5">
                <div class="login-bg mt-5">
                    <img src="<?=ROOT?>/assets/vectors/signup-vector.png" alt="signup vector image"/>
                </div>
                <div class="login-container">
                    <h2 class="text-center font-oswold pt-4">Create an Account</h2>
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
                    <div class="bg-white container text-center"> 
                        <a href="<?=ROOT?>/resend-email">Resend verification link?</a>
                    </div>
                    <?php endif;?>
                    <div class="login-form">
                    <form class="mt-5" action="" method="post">
                        <div class="my-2 d-flex signin-input">
                           <div>
                           <label class="label">Username</label>
                           <input value="<?=old_value('username')?>" class="form-input" type="text" placeholder="Username" name="username" required>
                           </div>
                           <div>
                           <label class="label">Email</label>
                           <input value="<?=old_value('email')?>"  class="form-input" type="email" placeholder="Email" name="email" required>
                           </div>
                        </div>
                        <div class="my-2 phone-container">
                           <label class="label">Phone Number:</label>
                           <input class="form-input phone-container" id="phone" type="tel" name="phone"/>
                        </div>
                        <div class="my-2 d-flex signin-input">
                           <div>
                           <label class="label">Password</label>
                           <input value="<?=old_value('password')?>"  class="form-input" type="password" placeholder="Password" name="password" required>
                           </div>
                           <div>
                           <label class="label">Confirm Pasword</label>
                           <input value="<?=old_value('confirmpassword')?>"  class="form-input" type="password" placeholder="Confirm Password" name="confirmpassword" required>
                           </div>
                        </div>
                        <div class="d-flex">
                            <div class="form-check text-start my-3 sign-up-text">
                            <label class="form-check-label" for="flexCheckDefault"> Accept Terms and conditions</label>
                            <input <?=old_checked('terms')?> name="terms" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault">
                            </div>
                        </div>
                        <div class="my-2">
                            <button class="btn-view btn-border-pop btn-background-slide uppercase">
                                Sign Up
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                            </svg>
                        </button>
                        </div>
                        <div class="my-4">
                            <h5>Already have an account? <a class="text-green" href="<?=ROOT?>/login">Login</a></h5>
                        </div>
                    </form>
                    <div class="alert alert-info" style="display: none;"></div>
                    </div>
                    <?php if(!empty($errors['username'])):?>
                    <div class="alert alert-danger text-center" role="alert">
                        <?=$errors['username'];?>
                    </div>
                <?php endif;?>
                <?php if(!empty($errors['email'])):?>
                    <div class="alert alert-danger text-center" role="alert">
                        <?=$errors['email'];?>
                    </div>
                <?php endif;?>
                <?php if(!empty($errors['phone'])):?>
                    <div class="alert alert-danger text-center" role="alert">
                        <?=$errors['phone'];?>
                    </div>
                <?php endif;?>
                <?php if(!empty($errors['password'])):?>
                    <div class="alert alert-danger text-center" role="alert">
                        <?=$errors['password'];?>
                    </div>
                <?php endif;?>
                <?php if(!empty($errors['terms'])):?>
                    <div class="alert alert-danger text-center" role="alert">
                        <?=$errors['terms'];?>
                    </div>
                <?php endif;?>
                </div>
                <!-- end logincontainer-->
            <div>
        </div>
                </div>
        <div id="footer">
            <?php
                include '../app/pages/includes/footer.php';
            ?>
        </div>
    </main>
    <script>
        const phoneInputField = document.querySelector("#phone");
        const phoneInput = window.intlTelInput(phoneInputField, {
         utilsScript:
       "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });
        const info = document.querySelector(".alert-info");
        function process(event) {
        event.preventDefault();
        const phoneNumber = phoneInput.getNumber();
        info.style.display = "";
        info.innerHTML = `Phone number in E.164 format: <strong>${phoneNumber}</strong>`;
        }
    </script>
    <?php
    include '../app/pages/includes/bottomnav.php';
    ?>
</body>
</html>