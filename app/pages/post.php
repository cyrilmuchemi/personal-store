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
        $slug = $url[1] ?? null;

        if($slug)
        {
            $query = "select * from blogs where slug = :slug limit 1";
            $row = query_row($query, ['slug'=>$slug]);
        }
    ?>
    <?php if(!empty($row)):?>
            <div class="col-md-8 container mt-5">
                <div class="blog-card-image">
                    <img src="<?=get_image($row['image'])?>" alt="blog post image" width="100%">
                </div>
                <div class="blog-card-content container">
                    <article class="mt-3"><?=date("jS M, Y", strtotime($row['date']))?></article>
                    <article class="font-oswold fs-700 mt-3"><?=esc($row['title'])?></article>
                    <div><?=nl2br($row['content'])?></div>
                </div>
            </div>
    <?php endif?>
    <?php
        include '../app/pages/includes/footer.php';
    ?>
</body>