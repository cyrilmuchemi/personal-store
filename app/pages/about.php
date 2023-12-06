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
            Customer-Centric Approach: Put your customers at the center of your business. Understand their needs, preferences, and pain points. Listen to their feedback and use it to improve your products or services continuously. Tailor Solutions: Offer personalized solutions to your clients based on their unique requirements. One size does not fit all, so customize your offerings to meet individual goals and objectives. Excellent Communication: Effective communication is vital in building strong relationships with clients. Be responsive, transparent, and maintain clear channels of communication. High-Quality Products/Services: Ensure that the products or services you offer are of high quality
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