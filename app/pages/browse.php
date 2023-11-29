<?php
            include '../app/pages/includes/head.php';
    ?>
    <?php
        include '../app/pages/includes/header.php';
    ?>
     <?php
        $limit = 8; 
        $offset = ($PAGE['page_number'] - 1) * $limit;

        $find = $_GET['find'] ?? null;
        $selectedCategories = $_GET['category'] ?? null;
        $categoryConditions = '';

        if (!empty($selectedCategories)) {
            $placeholders = implode(',', array_fill(0, count($selectedCategories), '?'));
            $categoryConditions = 'AND products.category_id IN (' . $placeholders . ')';
        
            $query_check = "SELECT products.*, categories.name AS category_name 
                            FROM products 
                            JOIN categories ON products.category_id = categories.id 
                            WHERE 1 $categoryConditions 
                            ORDER BY products.id DESC 
                            LIMIT $limit OFFSET $offset";
            $rows_check = query($query_check, $selectedCategories);

        }

        if($find)
        {

            $find = "%$find%";
            $query = "SELECT products.*, categories.name AS category_name FROM products JOIN categories ON products.category_id = categories.id WHERE (products.name LIKE :find OR categories.name LIKE :find) $categoryConditions ORDER BY products.id DESC LIMIT $limit OFFSET $offset";
            $rows = query($query, ['find'=>$find]);

        }else{
            $display_all =  "SELECT products.*, categories.name AS category_name FROM products JOIN categories ON products.category_id = categories.id ORDER BY products.id DESC LIMIT $limit OFFSET $offset";
            $display = query($display_all);
        }

    ?>
    <main>
        <div class="body-wrapper">
            <div class="browse-page">
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
                                <form method="GET">
                                <?php
                                    $query = "select * from categories order by id desc";
                                    $categories = query($query);
                                ?>
                                <?php if(!empty($categories)) : ?>
                                    <?php foreach($categories as $cat) : ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="category[]" value="<?= $cat['id'] ?>" id="category<?= $cat['id'] ?>" <?= isset($_GET['category']) && in_array($cat['id'], $_GET['category']) ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="category<?= $cat['id'] ?>">
                                                <?= $cat['name'] ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <button class="btn btn-success" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="display-sec">
                    <div id="productContainer" class="d-flex flex-wrap justify-content-center gap my-4">
                        <?php if(!empty($rows)) :?>
                            <?php foreach($rows as $row) :?>
                                <?php
                                    include '../app/pages/includes/product.php';
                                ?>
                            <?php endforeach; ?>
                        <?php elseif(!empty($rows_check)) :?>
                            <?php foreach($rows_check as $row) :?>
                                <?php
                                    include '../app/pages/includes/product.php';
                                ?>
                            <?php endforeach; ?>
                            <?php elseif(!empty($range)) :?>
                                <?php foreach($range as $row) :?>
                                    <?php
                                        include '../app/pages/includes/product.php';
                                    ?>
                                <?php endforeach; ?>
                        <?php else :?>
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
            <?php
                include '../app/pages/includes/bottomnav.php';
            ?>
          </div>
    </main>
</body>
</html>