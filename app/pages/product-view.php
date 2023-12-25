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
        <div class="details-box">
            <img src="<?=get_image($row['image'])?>" alt="product image">
            <div class=" text-center">
                <h4 class="pt-2"><span class="badge bg-secondary">Location:</span></h4>
                <div class="detail-text"><?=$row['account_location']?></div>
            </div>
            <div class=" text-center">
                <h4 class="pt-2"><span class="badge bg-secondary">Email:</span></h4>
                <div class="detail-text"><?=$row['fake_email']?></div>
            </div>
            <div class=" text-center">
                <h4 class="pt-2"><span class="badge bg-secondary">Account Metrics:</span></h4>
                <div class="detail-text"><?=$row['account_metrics']?></div>
            </div>
            <div class=" text-center">
                <h4 class="pt-2"><span class="badge bg-secondary">Published at:</span></h4>
                <div class="detail-text"><?=$row['created_at']?></div>
            </div>
        </div>
    </div>
    <div class="container my-4 col-md-6">
        <a href="<?=ROOT?>/cart-page"><button id="add-to-cart" class="btn btn-success mx-4 my-2" type="submit" value="<?=$row['id']?>">Purchase Product</button></a>
        <a href="<?=ROOT?>/home"><button class="btn btn-danger mx-4 my-2">Back to Homepage</button></a>
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