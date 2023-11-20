<?php
            include '../app/pages/includes/head.php';
    ?>
    <?php
        include '../app/pages/includes/header.php';
    ?>
     <?php
        $limit = 5; 
        $offset = ($PAGE['page_number'] - 1) * $limit;

        $find = $_GET['find'] ?? null;

        if($find)
        {
            $find = "%$find%";
            $query = "SELECT products.*, categories.name AS category_name FROM products JOIN categories ON products.category_id = categories.id WHERE products.name LIKE :find ORDER BY products.id DESC LIMIT $limit OFFSET $offset";
            $rows = query($query, ['find'=>$find]);

            $query_category =  "SELECT products.*, categories.name AS category_name FROM products JOIN categories ON products.category_id = categories.id WHERE categories.name LIKE :find ORDER BY products.id DESC LIMIT $limit OFFSET $offset";
            $category = query($query_category, ['find'=>$find]);
        }

        $display_all =  "SELECT products.*, categories.name AS category_name FROM products JOIN categories ON products.category_id = categories.id ORDER BY products.id DESC LIMIT 8 OFFSET $offset";
        $display = query($display_all);
    ?>
    <main>
        <div class="body-wrapper">
            <div class="d-flex mt-5 gap">
                <div class="search-sec">
                    <div class="browse-search">
                        <div class="box-search">
                            <form class="box-search-search" role="search">
                            <input value="<?=$_GET['find'] ?? ''?>" type="text" placeholder="search..." name="find" aria-label="Search"/>
                            </form>
                        </div>
                    </div>
                    <div class="browse-categories">
                        <div class="browse-categories-box">
                            <h4 class="mt-5">Categories</h4>
                            <div class="browse-categories-radio">
                                <?php
                                    $query = "select * from categories order by id desc";
                                    $categories = query($query);
                                ?>
                                <?php if(!empty($categories)) : ?>
                                    <?php foreach($categories as $cat) : ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="<?=$cat['id']?>"id="defaultCheck2">
                                            <label class="form-check-label" for="defaultCheck2">
                                                <?=$cat['name']?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="browse-range">
                            <label for="customRange2" class="form-label">Price Range--(Ksh 100 - 100,000)</label>
                            <input type="range" class="form-range" min="0" max="5" id="customRange2">
                        </div>
                    </div>
                </div>
                <div class="display-sec">
                    <div class="d-flex flex-wrap justify-content-center gap my-4">
                        <?php if(!empty($rows)) :?>
                            <?php foreach($rows as $row) :?>
                                <?php
                                    include '../app/pages/includes/product.php';
                                ?>
                            <?php endforeach; ?>
                        <?php elseif(!empty($category)) :?>
                            <?php foreach($category as $row) :?>
                                <?php
                                    include '../app/pages/includes/product.php';
                                ?>
                            <?php endforeach; ?>
                        <?php elseif(empty($rows)) :?>
                            <?php foreach($display as $row) :?>
                                <?php
                                    include '../app/pages/includes/product.php';
                                ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </div>
                        <div class="d-flex justify-content-center my-4">
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
                </div>
            </div>
            <div id="footer" class="mt-4">
                <?php
                    include '../app/pages/includes/footer.php';
                ?>
            </div>
          </div>
    </main>
</body>
</html>