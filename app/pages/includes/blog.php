<?php
    $limit = 4; 
    $query = "select * from blogs order by id desc limit $limit";
    $rows = query($query);
?>

<?php if(!empty($rows)) :?>
    <?php foreach($rows as $row) :?>
        <div class="blog-card" type="button">
                <div class="blog-card-image">
                <a href="<?=ROOT?>/post/<?=$row['slug']?>" class="decoration-none">
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
    <?php endforeach; ?>
<?php endif; ?>
