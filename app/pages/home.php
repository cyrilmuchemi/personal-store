    <?php
            include '../app/pages/includes/head.php';
    ?>
    <?php
        include '../app/pages/includes/header.php';
    ?>
    <?php
        include '../app/pages/includes/slider.php';
    ?>
    <main>
        <div class="body-wrapper">
            <div class="hero container">
                <div class="d-flex justify-content-center">
                    <form action="<?=ROOT?>/search" class="search-bar my-4" role="search">
                    <input value="<?=$_GET['find'] ?? ''?>" type="text" placeholder="search account" name="find" aria-label="Search"/>
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </button>
                    </form>
                </div>
                  <div class="mt-4">
                    <?php
                    include '../app/pages/includes/category.php';
                    ?>
                  </div>
            </div>
            <div class="container">
                <h3 class="font-oswold text-center custom-top fs-800">Latest Products</h3>
                <p class="text-center">
                  Below are some of our latest digital products.</br>Fell free to browse through them.
                </p>
            </div>
            <div id="latest products" class="container mt-5">
              <div id="latest" class="d-flex product-container flex-wrap">
                  <?php
                    include '../app/pages/includes/latest-product.php';
                  ?>
              </div>
            </div>
            <div class="container">
                <h3 class="font-oswold text-center custom-top fs-800">Discount Products %</h3>
            </div>
            <div id="discount products" class="container mt-5">
              <div id="latest" class="d-flex product-container flex-wrap">
                  <?php
                    include '../app/pages/includes/discount-product.php';
                  ?>
              </div>
            </div>
            <?php
                include '../app/pages/includes/footer.php';
             ?>
          </div>
    </main>
</body>
</html>