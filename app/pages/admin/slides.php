<?php if($action == "add") :?>
  <!-- Add new slide -->
  <div class="col-md-6 mx-auto">
        <form method="post" enctype="multipart/form-data">
        <h1 class="h3 mb-3 fw-normal text-center">Add a new Slide</h1>

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
        <input  name="caption" type="text" class="form-control">
        <label for="floatingPassword">Caption</label>
        </div>
        <button class="mt-4 btn btn-primary w-100 py-2" type="submit">Add Slide</button>
        </form>
    </div>
 <!--End Add new category -->

 <?php else:?>
<div class="text-center mb-4">
    <h4>Sldes
      <a class="text-white decoration-none" href="<?=ROOT?>/admin/slides/add">
        <button class="btn btn-primary"> Add New </button>
      </a>
    </h4>
</div>

<?php
    $limit = 10; 
    $offset = ($PAGE['page_number'] - 1) * $limit;
    $query = "select * from slides order by id desc limit $limit offset $offset";
    $rows = query($query);
?>
<table class="table">
      <tr>
        <th>#</th>
        <th>Image</th>
        <th>Caption</th>
        <th>Date</th>
        <th>Action</th>
      </tr>

<?php if(!empty($rows)) :?>
    <?php foreach($rows as $row) :?>
        <tr>
          <td><?=$row['id']?></td>
          <td><img src="<?=get_image($row['image'])?>" alt="slides image" width="100"></td>
          <td><?=$row['caption']?></td>
          <td><?=date("jS M, Y", strtotime($row['date']))?></td>
          <td>
          <a class="text-white decoration-none" href="<?=ROOT?>/admin/slides/delete/<?=$row['id']?>">
            <button class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
          </a>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php endif; ?>  
    </table>
    <?php endif; ?>  