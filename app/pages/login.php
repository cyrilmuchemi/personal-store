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
    <title>Accounts Zone - Login</title>
</head>
<body class="font-default">
    <?php
        include '../app/pages/includes/header.php';
    ?>
    <main>
        <div class="container">
            <div class="login-box d-flex justify-content-center my-5">
                <div class="login-bg mt-5">
                    <img src="<?=ROOT?>/assets/vectors/login-vector.png" alt="login vector image"/>
                </div>
                <div class="login-form">
                    <h2 class="text-center font-oswold">Sign In Your Account</h2>
                    <form class="mt-5" action="" method="post">
                        <label>Username</label>
                        <div class="my-2">
                            <input class="form-input" type="text" placeholder="User Name" name="username" required>
                        </div>
                        <label>Password</label>
                        <div class="my-2">
                            <input class="form-input" type="text" placeholder="Password" name="username" required>    
                        </div> 
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="form-check text-start my-3">
                                <input name="remember" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Remember me
                                </label>
                            </div>
                            <div class="px-4 text-green">Forgot Your Password?</div>
                        </div>
                        <div class="my-2">
                            <button class="btn-view btn-border-pop btn-background-slide uppercase">
                                Sign In
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                            </svg>
                        </button>
                        </div>
                        <div class="my-4">
                            <h5>Don't have an account? <span class="text-green">Create Account</span></h5>
                        </div>
                    </form>
                </div>
            <div>
        </div>
    </main>
    <?php
        include '../app/pages/includes/footer.php';
    ?>
    <script src="<?=ROOT?>/assets/js/index.js"></script>
    <script src="<?=ROOT?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>