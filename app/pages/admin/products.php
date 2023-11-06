<?php if($action == "add") :?>
  <!-- Add new product -->
  <div class="col-md-6 mx-auto">
        <form method="post" enctype="multipart/form-data">
        <h1 class="h3 mb-3 fw-normal text-center">Add a new product</h1>

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
        <select name="category_id" class="form-select mb-3">
                <?php
                    $query = "select * from categories order by id desc";
                    $categories = query($query);
                ?>
            <option selected>Select Catergory</option>
            <?php if(!empty($categories)) : ?>
                <?php foreach($categories as $cat) : ?>
                    <option <?=old_select('category_id', $cat['id'])?> value="<?=$cat['id']?>"><?=$cat['name']?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <div class="form-floating mb-3">
        <input name="account_name" type="text" class="form-control">
        <label for="floatingPassword">Account Name</label>
        </div>
        <div class="form-floating mb-3">
        <input name="account_email" type="text" class="form-control">
        <label for="floatingPassword">Account Email</label>
        </div>
        <div class="form-floating mb-3">
        <input name="account_password" type="text" class="form-control">
        <label for="floatingPassword">Account Password</label>
        </div>
        <div class="form-floating mb-3">
        <input name="account_metrics" type="text" class="form-control">
        <label for="floatingPassword">Account Metrics</label>
        </div>
        <div class="form-floating mb-3">
        <input name="account_location" type="text" class="form-control">
        <label for="floatingPassword">Account Location</label>
        </div>
        <div class="form-floating mb-3">
        <input name="account_old_price" type="text" class="form-control">
        <label for="floatingPassword">Account Old Price</label>
        </div>
        <div class="form-floating mb-3">
        <input name="account_new_price" type="text" class="form-control">
        <label for="floatingPassword">Account New Price</label>
        </div>
        <div class="form-floating mb-3">
        <input name="small_description" type="text" class="form-control">
        <label for="floatingPassword">Small Description</label>
        </div>
        <select name="status" class="form-select">
            <option selected>Status</option>
            <option value="1">New</option>
            <option value="2">Discount</option>
        </select>
        <button class="mt-4 btn btn-primary w-100 py-2" type="submit">Add Account</button>
        </form>
    </div>
 <!--End Add new product -->
 
<?php endif;?>