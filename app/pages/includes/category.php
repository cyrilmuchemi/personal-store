<?php
    $limit = 5; 
    $query = "select * from categories order by id desc limit $limit";
    $rows = query($query);
?>

<?php if(!empty($rows)) :?>
 <div class="d-flex flex-wrap justify-content-center cat-gap" type="button">
    <?php foreach($rows as $row) :?>
        <div class="category-card">
            <div class="img-box d-flex justify-content-center">
                <img src="<?=get_image($row['image'])?>" alt="category image" width="100">
            </div>
            <div class="content-box font-oswald">
                <h3><?=$row['name']?></h3>
            </div>
        </div>   
    <?php endforeach; ?>
 </div>
<?php endif; ?>