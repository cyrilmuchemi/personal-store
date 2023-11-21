<?php
        include '../app/pages/includes/head.php';
?>
<?php
    include '../app/pages/includes/header.php';
?>
<?php
    $slug = $url[1] ?? null;

    if($slug)
    {
        $query =  "SELECT products.*, categories.name AS category_name FROM products JOIN categories ON products.category_id = categories.id WHERE products.slug = :slug limit 1";
        $row = query_row($query, ['slug'=>$slug]);
    }
?>
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
<?php endif?>
<?php
        include '../app/pages/includes/footer.php';
    ?>
</body>