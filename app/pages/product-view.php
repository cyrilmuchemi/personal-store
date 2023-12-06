<?php
      include '../app/pages/includes/access.php';
      access('CUSTOMER');
      
    $slug = $url[1] ?? null;

    if($slug)
    {
        $query =  "SELECT products.*, categories.name AS category_name FROM products JOIN categories ON products.category_id = categories.id WHERE products.slug = :slug limit 1";
        $row = query_row($query, ['slug'=>$slug]);
    }
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
    <div class="product-view">
            <?php if(!empty($row)):?>
            <div class="product-card position-relative" type="button">
                <div class="product-content">
                    <img src="<?=get_image($row['image'])?>" alt="product image">
                    <h6><?= $row['category_name'] ?></h6>
                    <h4><?=$row['name']?></h4>
                    <p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-lightning-fill" viewBox="0 0 16 16">
                        <path d="M5.52.359A.5.5 0 0 1 6 0h4a.5.5 0 0 1 .474.658L8.694 6H12.5a.5.5 0 0 1 .395.807l-7 9a.5.5 0 0 1-.873-.454L6.823 9.5H3.5a.5.5 0 0 1-.48-.641l2.5-8.5z"/>
                        </svg>
                    <span><?=$row['sales']?></span>
                    <span>sales</span>
                    </p>
                    <div class="button-row d-flex justify-content-between">
                        <button class="price-box bg-white text-green font-oswold">
                            <span>KSH</span>
                            <span><?=$row['selling_price']?></span>
                        </button>
                        <button class="btn-view btn-border-pop btn-background-slide uppercase">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                            </svg>
                            Purchase
                        </button>
                    </div>
                </div>
            </div>
        <div class="details-box">
            <div class="details text-center">
                <h4 class="py-2"><span class="badge bg-secondary">Description:</span></h4>
                <div class="detail-text"><?=$row['small_description']?></div>
            </div>
            <div class="details text-center">
                <h4 class="py-2"><span class="badge bg-secondary">Location:</span></h4>
                <div class="detail-text"><?=$row['account_location']?></div>
            </div>
            <div class="details text-center">
                <h4 class="py-2"><span class="badge bg-secondary">Email:</span></h4>
                <div class="detail-text"><?=$row['owner_email']?></div>
            </div>
            <div class="details text-center">
                <h4 class="py-2"><span class="badge bg-secondary">Account Metrics:</span></h4>
                <div class="detail-text"><?=$row['account_metrics']?></div>
            </div>
            <div class="details text-center">
                <h4 class="py-2"><span class="badge bg-secondary">Published at:</span></h4>
                <div class="detail-text"><?=$row['created_at']?></div>
            </div>
        </div>
    </div>
    <?php endif?>
    <div class="container">
    <h3 class="font-oswold custom-top">Similar Products</h3>
        </div>
        <div id="discount products" class="container mt-4">
            <div class="wrapper">
                <div class="carousel owl-carousel d-flex justify-content-center">
                <?php
                    include '../app/pages/includes/discount-product.php';
                ?>
                </div>
            </div>
        </div>
    <?php
        include '../app/pages/includes/footer.php';
    ?>
     <script src="<?=ROOT?>/assets/js/jquery.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
             <script>
                  $(".carousel").owlCarousel({
                    loop:true,
                    autoplay: true,
                    autoplayTimeout: 2000,
                    autoplayHoverPause: true,
                    responsive: {
                        0:{
                            items: 1,
                        },
                        800:{
                            items: 2,
                        },
                        1000:{
                            items: 3,
                        },

                        1400:{
                            items: 4,
                        }
                    }
                  });
             </script>
</div>
<?php
    include '../app/pages/includes/bottomnav.php';
?>
</body>
</html>