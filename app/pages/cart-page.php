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
        <div class="cart-body">
            <div class="cart-header">
                <h3 class="font-oswold text-green">SHOPPING CART</h3>
            </div>
            <div class="cart-card"></div>
        </div>
    </div>
    <?php
        include '../app/pages/includes/footer.php';
    ?>
    <?php
    include '../app/pages/includes/bottomnav.php';
    ?>
</body>