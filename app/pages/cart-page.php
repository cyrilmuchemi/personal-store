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
        <div class="cart-body"></div>
    </div>
    <?php
        include '../app/pages/includes/footer.php';
    ?>
    <?php
    include '../app/pages/includes/bottomnav.php';
    ?>
</body>