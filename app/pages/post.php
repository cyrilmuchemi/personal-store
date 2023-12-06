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

        if(!empty($row)){
            $query_others = "select * from blogs where id != :current_id order by id desc";
            $rows_others = query($query_others, ['current_id' => $row['id']]);
        }
    }
?>
    <div id="loader-overlay">
        <div class="loader"></div>
    </div>
    <main id="main" class="d-flex flex-column">
    <div class="post-page">
            <?php if(!empty($row)):?>
            <div class="col-md-8 container mt-5">
                <div class="blog-card-image">
                    <img src="<?=get_image($row['image'])?>" alt="blog post image" width="100%">
                </div>
                <div class="blog-card-content container">
                    <article class="mt-3"><?=date("jS M, Y", strtotime($row['date']))?></article>
                    <article class="font-oswold fs-700 mt-3"><?=esc($row['title'])?></article>
                    <div id="content"><?=nl2br($row['content'])?></div>
                </div>
            </div>
            <?php endif?>
            <?php if(!empty($rows_others)):?>
                <div class="other-posts container mt-3 sm-col-md-6">
                    <h4 class="mt-3 font-oswold">Latest Posts</h4>
                <?php foreach($rows_others as $other) :?>
                    <div class="d-flex my-4 other-box">
                        <a href="<?=ROOT?>/post/<?=$other['slug']?>">
                            <img src="<?=get_image($other['image'])?>" alt="blog post image" width="180">
                        </a>
                        <div class="d-flex flex-column mx-4">
                            <article><?=date("jS M, Y", strtotime($other['date']))?></article>
                            <article class="font-oswold"><?=esc($other['title'])?></article>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            <?php endif?>
    </div>
    <?php
        include '../app/pages/includes/footer.php';
    ?>
    </main>
    <?php
    include '../app/pages/includes/bottomnav.php';
    ?>
    </body>
    </html>