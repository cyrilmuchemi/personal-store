<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/index.css">
    <link href="<?=ROOT?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500&family=Poppins:ital,wght@0,300;1,500&display=swap" rel="stylesheet">
    <title>Accounts Zone - Home</title>
</head>
<body class="font-default">
    <?php
        include '../app/pages/includes/header.php';
    ?>
    <?php
        $limit = 5; 
        $offset = ($PAGE['page_number'] - 1) * $limit;

        $find = $_GET['find'] ?? null;

        if($find)
        {
            $find = "%$find%";
            $query = "SELECT products.*, categories.name AS category_name FROM products JOIN categories ON products.category_id = categories.id WHERE products.name LIKE :find ORDER BY products.id DESC LIMIT $limit OFFSET $offset";
            $rows = query($query, ['find'=>$find]);

            $query_category =  "SELECT products.*, categories.name AS category_name FROM products JOIN categories ON products.category_id = categories.id WHERE categories.name LIKE :find ORDER BY products.id DESC LIMIT $limit OFFSET $offset";
            $category = query($query_category, ['find'=>$find]);
        }
    ?>
<div class="container mt-5">
    <h3>Search</h3>
<div class="d-flex mt-5 col-md-10">
<?php if(!empty($rows)) :?>
    <?php foreach($rows as $row) :?>
        <?php
            include '../app/pages/includes/product.php';
        ?>
    <?php endforeach; ?>
<?php elseif(!empty($category)) :?>
    <?php foreach($category as $row) :?>
        <?php
            include '../app/pages/includes/product.php';
        ?>
    <?php endforeach; ?>
<?php elseif(empty($rows)) :?>
        <div class="alert alert-danger">Item Not Found. <a href="<?=ROOT?>/home">Go back to Home Page</a></div>
<?php endif; ?>
</div>
<div class="col-md-12 mt-5">
      <a href="<?=$PAGE['first_link']?>">
        <button class="btn btn-success" type="button">First Page</button>
      </a>
      <a href="<?=$PAGE['prev_link']?>">
        <button class="btn btn-success mx-3" type="button">Prev Page</button>
      </a>
      <a href="<?=$PAGE['next_link']?>">
        <button class="btn btn-success float-end" type="button">Next Page</button>
      </a>
</div>
</div>
    <?php
        include '../app/pages/includes/footer.php';
    ?>
</body>