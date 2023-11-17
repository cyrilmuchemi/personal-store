<?php
            include '../app/pages/includes/head.php';
    ?>
    <?php
        include '../app/pages/includes/header.php';
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
                <div class="display-sec"></div>
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