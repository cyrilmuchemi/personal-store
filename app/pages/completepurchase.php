<?php
include '../app/pages/includes/access.php';
access('CUSTOMER');
?>
<?php
include '../app/pages/includes/head.php';
?>
<?php
include '../app/pages/includes/header.php';
?>
<div id="loader-overlay">
<div class="loader"></div>
</div>
<div id="main" class="body-wrapper">
    <div class="container">
        <div class="pt-5">
            <?php  if(isset($_SESSION['account_sold'])):?>
                <div class="alert alert-success text-center" role="alert">
                    <?php 
                    echo "</p>".$_SESSION['account_sold']."</p>";
                    unset($_SESSION['account_sold']);
                    ?>
                </div>
                <button class="btn btn-success">Go Home</button>
            <?php endif;?>
        </div>
    </div>
</div>
<?php
    include '../app/pages/includes/footer.php';
?>
<?php
    include '../app/pages/includes/bottomnav.php';
?>
