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
<?php else :?>
    <div class="text-center mb-4">
        <h4>Products
        <a class="text-white decoration-none" href="<?=ROOT?>/admin/products/add">
            <button class="btn btn-primary"> Add New </button>
        </a>
        </h4>
    </div>

    <?php
        $limit = 3; 
        $offset = ($PAGE['page_number'] - 1) * $limit;
        $query = "select * from products where status = 1 order by id desc limit $limit offset $offset";
        $rows = query($query);
        $query_discount = "select * from products where status = 2 order by id desc limit $limit offset $offset";
        $rows_dis = query($query_discount);
    ?>

    <div><h4>New Products</h4></div>
    <div class="d-flex">
    <?php if(!empty($rows)) :?>
    <?php foreach($rows as $row) :?>
        <div class="product-card position-relative" type="button">
            <div class="product-badge position-absolute px-2 py-2">
                <button class="btn-new text-white">New</button>  
            </div>
            <img src="<?=get_image($row['image'])?>" alt="product image">
            <div class="product-content">
                <h5>Streaming</h5>
                <h6 class="fs-700"><?=$row['name']?></h6>
                <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-lightning-fill" viewBox="0 0 16 16">
                    <path d="M5.52.359A.5.5 0 0 1 6 0h4a.5.5 0 0 1 .474.658L8.694 6H12.5a.5.5 0 0 1 .395.807l-7 9a.5.5 0 0 1-.873-.454L6.823 9.5H3.5a.5.5 0 0 1-.48-.641l2.5-8.5z"/>
                    </svg>
                <span>10</span>
                <span>sales</span>
                </p>
                <div class="button-row d-flex justify-content-between">
                <button class="price-box bg-white text-green font-oswold">
                    <span>KSH</span>
                    <span><?=$row['selling_price']?></span>
                </button>
                <button class="btn-view btn-border-pop btn-background-slide uppercase">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                    </svg>
                    Purchase
                </button>
                </div>
            </div>
            </div>  
            <a class="text-white decoration-none" href="<?=ROOT?>/admin/products/delete/<?=$row['id']?>">
            <button class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
            </a>                  
    <?php endforeach; ?>
    <?php endif; ?>
    </div>
    <div class="mt-4"><h4>Discount Products</h4></div>
    <div class="d-flex">
    <?php if(!empty($rows_dis)) :?>
    <?php foreach($rows_dis as $dis) :?>
        <div class="product-card position-relative pointer" type="button">
            <div class="product-badge position-absolute px-2 py-2">
                <button class="btn-discount text-white">
                    <?php
                     echo (($dis['original_price'] - $dis['selling_price']) / $dis['original_price']) * 100;
                    ?>%
                </button>
            </div>
            <img src="<?=get_image($dis['image'])?>" alt="product image">
            <div class="product-content">
                <h5>Streaming</h5>
                <h6 class="fs-700"><?=$dis['name']?></h6>
                <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-lightning-fill" viewBox="0 0 16 16">
                    <path d="M5.52.359A.5.5 0 0 1 6 0h4a.5.5 0 0 1 .474.658L8.694 6H12.5a.5.5 0 0 1 .395.807l-7 9a.5.5 0 0 1-.873-.454L6.823 9.5H3.5a.5.5 0 0 1-.48-.641l2.5-8.5z"/>
                    </svg>
                <span>10</span>
                <span>sales</span>
            </p>
                <div class="button-row d-flex justify-content-between">
                <button class="price-box bg-white text-green font-oswold">
                    <span>KSH</span>
                    <span><?=$dis['selling_price']?></span>
                </button>
                <button class="btn-view btn-border-pop btn-background-slide uppercase">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                    </svg>
                    Purchase
                </button>
                </div>
            </div>
            </div>       
            <a class="text-white decoration-none" href="<?=ROOT?>/admin/products/delete/<?=$dis['id']?>">
            <button class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
            </a>             
    <?php endforeach; ?>
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
<?php endif;?>