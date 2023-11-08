<?php if($action == "add") :?>
  <!-- Add new product -->
  <div class="col-md-6 mx-auto">
        <form method="post" enctype="multipart/form-data">
        <h1 class="h3 mb-3 fw-normal text-center">Add a new Blog Post</h1>

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
        <input name="title" type="text" class="form-control" required>
        <label>Blog Title</label>
        </div>
        <div class="form-floating">
            <textarea name="content" class="form-control" id="floatingTextarea"></textarea>
            <label for="floatingTextarea">Blog Content</label>
        </div>
        <button class="mt-4 btn btn-primary w-100 py-2" type="submit">Add Post</button>
        </form>
    </div>
 <!--End Add new product -->
<?php else :?>
    <div class="text-center mb-4">
        <h4>Blogs
        <a class="text-white decoration-none" href="<?=ROOT?>/admin/blogs/add">
            <button class="btn btn-primary"> Add New </button>
        </a>
        </h4>
    </div>

    <?php
        $limit = 4; 
        $offset = ($PAGE['page_number'] - 1) * $limit;
        $query = "select * from blogs order by id desc limit $limit offset $offset";
        $rows = query($query);
    ?>

<div class="d-flex">
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
    </a>
    <?php if(!empty($errors['image'])) :?>
        <?=$errors['image']?>
    <?php endif;?>
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