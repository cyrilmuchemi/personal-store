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