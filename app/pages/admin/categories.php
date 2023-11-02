<?php if($action == "add") :?>
  <!-- Add new category -->
  <div class="col-md-6 mx-auto">
        <form method="post" enctype="multipart/form-data">
        <h1 class="h3 mb-3 fw-normal text-center">Add a new category</h1>

        <div class="my-2 mb-4">
            <label class="d-block">
                <img class="d-block mx-auto image-preview-edit" src="<?=get_image('')?>" style="cursor: pointer; width: 150px; height: 150px; object-fit: cover;"/>
                <input onchange="display_image_edit(this.files[0])" type="file" name="image" class="d-none"/>
            </label>
            <script>
                function display_image_edit(file){
                    document.querySelector(".image-preview-edit").src = URL.createObjectURL(file);
                }
            </script>
        </div>

        <div class="form-floating mb-3">
        <input  value="<?=old_value('name')?>" name="category_name" type="text" class="form-control">
        <label for="floatingPassword">Category Name</label>
        </div>
        <button class="mt-4 btn btn-primary w-100 py-2" type="submit">Add Category</button>
        </form>
    </div>
 <!--End Add new user -->

<?php else:?>
<div class="text-center mb-4">
    <h4>Categories
      <a class="text-white decoration-none" href="<?=ROOT?>/admin/categories/add">
        <button class="btn btn-primary"> Add New </button>
      </a>
    </h4>
</div>


<?php
    $limit = 5; 
    $offset = ($PAGE['page_number'] - 1) * $limit;
    $query = "select * from categories order by id desc limit $limit offset $offset";
    $rows = query($query);
?>

<?php if(!empty($rows)) :?>
    <?php foreach($rows as $row) :?>
    <div class="col">
    <div class="category-card-container">
        <div class="category-card">
            <div class="img-box d-flex justify-content-center">
                <img src="<?=get_image($row['image'])?>" alt="category image" width="100">
            </div>
        <div class="content-box font-oswald">
            <h3><?=$row['name']?></h3>
        </div>
        </div>    
    </div>
    <a class="text-white decoration-none" href="<?=ROOT?>/admin/categories/delete/<?=$row['id']?>">
        <button class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
    </a>
    </div>
    <?php if(!empty($errors['image'])) :?>
        <?=$errors['image']?>
    <?php endif;?>
    <?php endforeach; ?>
    <?php endif; ?>

<?php endif;?>