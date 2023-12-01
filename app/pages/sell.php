<?php
    if(!empty($_POST)){

        $errors = [];

        $query = "select id from sellers where email = :email limit 1";
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

        $query = "select id from sellers where phone = :phone limit 1";
        $phone = query($query, ['phone' => $_POST['phone']]);


        if(empty($_POST['phone']))
        {
            $errors['phone'] = "Please enter your phone number!";
        }else
        if($phone)
        {
            $errors['phone'] = "That phone number is in use!";
        }

        if(empty($_POST['account_name']))
        {
            $errors['account_name'] = "Please enter your account name!";
        }

        
        if(empty($_POST['account_price']))
        {
            $errors['account_price'] = "Please enter your account price!";
        }

        if(empty($errors)){

            $data = [];

            $data['email'] = $_POST['email'];
            $data['phone'] = $_POST['phone'];
            $data['role'] = "seller";
            $data['account_name'] = $_POST['account_name'];
            $data['account_price'] = $_POST['account_price'];

            $query = "insert into sellers (email, phone, role, account_name, account_price) values (:email, :phone, :role, :account_name, :account_price)";
            query($query, $data);
            $_SESSION['status'] = "Thank You For Applying! We'll Reach out to You Soon";
        }
    }
?>

<?php
    include '../app/pages/includes/head.php';
?>
<?php
    include '../app/pages/includes/header.php';
?>
 <div id="main" class="body-wrapper">
    <h1 class="text-green font-oswold text-center pt-5">Sell Your Account</h1>
    <h4 class="text-center">Fill in the form below and our team will reach out to communicate further</h4>
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
    <div class="d-flex justify-content-center mt-4">
            <form class="sell-form" action="" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
                    <div>We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="phone" class="form-control" name="phone">
                    <div>We'll never share your contact with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="account" class="form-label">Account Name</label>
                    <input type="text" class="form-control" name="account_name">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Best Price in Kenyan Shillings</label>
                    <input type="number" class="form-control" name="account_price">
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>            
    </div>
    <div class="d-flex justify-content-center flex-column mt-3">
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
                <?php if(!empty($errors['account_name'])):?>
                    <div class="alert alert-danger text-center" role="alert">
                        <?=$errors['account_name'];?>
                    </div>
                <?php endif;?>
                <?php if(!empty($errors['account_price'])):?>
                    <div class="alert alert-danger text-center" role="alert">
                        <?=$errors['account_price'];?>
                    </div>
                <?php endif;?>
    </div>
    <div id="footer" class="mt-4">
        <?php
            include '../app/pages/includes/footer.php';
        ?>
    </div>
    <?php
        include '../app/pages/includes/bottomnav.php';
    ?>
 </div>
 </body>
</html>