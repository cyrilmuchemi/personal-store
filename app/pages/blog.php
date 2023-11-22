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
    <title>Accounts Zone - Blog</title>
</head>
<body class="font-default">
    <?php
        include '../app/pages/includes/header.php';
    ?>
    <?php
        $limit = 3; 
        $offset = ($PAGE['page_number'] - 1) * $limit;
        $query = "select * from blogs order by id desc limit $limit offset $offset";
        $rows = query($query);
    ?>
<div class="container">
<div class="blog-page mt-5">
<?php if(!empty($rows)) :?>
    <?php foreach($rows as $row) :?>
            <div class="blog-card" type="button">
                    <div class="blog-card-image">
                    <a href="<?=ROOT?>/post/<?=$row['slug']?>">
                    <img src="<?=get_image($row['image'])?>" alt="blog post image" width="100%">
                    </a>
                    </div>
                    <div class="blog-card-content container">
                        <article class="mt-3"><?=date("jS M, Y", strtotime($row['date']))?></article>
                        <article class="font-oswold fs-700 mt-3"><?=esc($row['title'])?></article>
                        <a href="<?=ROOT?>/post/<?=$row['slug']?>" class="decoration-none">
                        <button class="btn-view btn-border-pop btn-background-slide uppercase mt-3 mb-3">
                            Read More
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                            </svg>
                        </button>
                        </a>
                    </div>
                </div>
        </a>
    <?php endforeach; ?>
    <?php elseif(empty($rows)) :?>
        <div class="alert alert-danger">No Blogs!. <a href="<?=ROOT?>/home">Go back to Home Page</a></div>
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