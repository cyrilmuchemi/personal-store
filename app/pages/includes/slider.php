<link rel="stylesheet" href="<?=ROOT?>/assets/slider/ism/css/my-slider.css"/>
<script src="<?=ROOT?>/assets/slider/ism/js/ism-2.2.min.js"></script>

<?php
$limit = 10; 
$offset = ($PAGE['page_number'] - 1) * $limit;
$query = "SELECT * FROM slides ORDER BY id DESC LIMIT $limit OFFSET $offset";
$rows = query($query);
?>

<div class="ism-slider" data-transition_type="fade" data-play_type="loop" id="my-slider">
    <ol>
        <?php foreach ($rows as $row) : ?>
            <li>
                <img src="<?=get_image($row['image'])?>">
                <p class="ism-caption"><?=$row['caption']?></p>
            </li>
        <?php endforeach; ?>
    </ol>
</div>
