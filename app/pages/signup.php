<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/index.css">
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500&family=Poppins:ital,wght@0,300;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <title>Accounts Zone - Signup</title>
</head>
<body class="font-default">
    <?php
        include '../app/pages/includes/header.php';
    ?>
    <main>
        <div class="container">
            <div class="login-box d-flex my-5">
                <div class="login-bg mt-5">
                    <img src="<?=ROOT?>/assets/vectors/signup-vector.png" alt="signup vector image"/>
                </div>
                <div class="login-container">
                    <h2 class="text-center font-oswold pt-4">Create an Account</h2>
                    <div class="login-form">
                    <form class="mt-5" action="" method="post">
                        <div class="my-2 d-flex signin-input">
                           <div>
                           <label class="label">Username</label>
                           <input class="form-input" type="text" placeholder="Username" name="username" required>
                           </div>
                           <div>
                           <label class="label">Email</label>
                           <input class="form-input" type="text" placeholder="Email" name="email" required>
                           </div>
                        </div>
                        <div class="my-2 phone-container">
                           <label class="label">Phone Number:</label>
                           <input class="form-input  phone-container" id="phone" type="tel" name="phone" />
                        </div>
                        <div class="my-2 d-flex signin-input">
                           <div>
                           <label class="label">Password</label>
                           <input class="form-input" type="text" placeholder="Password" name="password" required>
                           </div>
                           <div>
                           <label class="label">Confirm Pasword</label>
                           <input class="form-input" type="text" placeholder="Confirm Password" name="confirmpassword" required>
                           </div>
                        </div>
                        <div class="d-flex">
                            <div class="form-check text-start my-3 sign-up-text">
                                <input name="remember" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Accept Terms and conditions
                                </label>
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
                            <h5>Already have an account? <span class="text-green">Login</span></h5>
                        </div>
                    </form>
                    <div class="alert alert-info" style="display: none;"></div>
                    </div>
                </div>
            <div>
        </div>
    </main>
    <?php
        include '../app/pages/includes/footer.php';
    ?>
    <?php
        include '../app/pages/includes/circle.php';
    ?>
    <script src="<?=ROOT?>/assets/js/index.js"></script>
    <script src="<?=ROOT?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
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
</body>
</html>