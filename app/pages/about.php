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
    <div class="container about-container pt-5">
        <div class="about-content">
            <h1 class="text-green font-oswold">Why Choose Us?</h1>
            <p>
            Say goodbye to waiting for scammers to respond. Our swift and secure delivery system ensures your digital goodies land in your inbox at warp speed. Because why wait when you can have it now?
            </p>
            <p>
            Trust is our currency. With cutting-edge encryption and secure payment gateways, your digital journey with us is not only exciting but also safeguarded at every turn.
            </p>
        </div>
        <div class="about-image">
            <img src="<?=ROOT?>/assets/vectors/about-vector.png" alt="about vector image"/>
        </div>
    </div>
        <div class="faqs mt-5">
            <h2 class="text-green font-oswold">Frequently Asked Questions</h2>
            <?php
                include '../app/pages/includes/accordion.php';
            ?>
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