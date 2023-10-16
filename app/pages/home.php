<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/index.css">
    <link href="<?=ROOT?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500&family=Poppins:ital,wght@0,300;1,500&display=swap" rel="stylesheet">
    <title>Accounts Zone - Home</title>
</head>
<body class="font-default">
    <?php
        include '../app/pages/includes/header.php';
    ?>
    <!--slider -->
        <link rel="stylesheet" href="<?=ROOT?>/assets/slider/ism/css/my-slider.css"/>
        <script src="<?=ROOT?>/assets/slider/ism/js/ism-2.2.min.js"></script>
        <div class="ism-slider" data-transition_type="fade" data-play_type="loop" id="my-slider">
        <ol>
            <li>
            <img src="<?=ROOT?>/assets/slider/ism/image/slides/dstv.png">
            </li>
            <li>
            <img src="<?=ROOT?>/assets/slider/ism/image/slides/verbit.png">
            </li>
            <li>
            <img src="<?=ROOT?>/assets/slider/ism/image/slides/writerbay.png">
            </li>
            <li>
            <img src="<?=ROOT?>/assets/slider/ism/image/slides/netflix.png">
            </li>
        </ol>
        </div>
    <!--end slider -->
    <main>
        <div class="body-wrapper">
           <div class="hero container">
                <div class="d-flex justify-content-center">
                    <form action="" class="search-bar my-4">
                    <input type="text" placeholder="search account" name="q"/>
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </button>
                    </form>
                </div>
                <div class="row my-4">
                    <div class="col">
                        <div class="category-card-container">
                            <div class="category-card">
                                <div class="img-box d-flex justify-content-center">
                                    <img src="<?=ROOT?>/assets/vectors/streaming.png" alt="category image" width="100">
                                </div>
                                 <div class="content-box">
                                    <h3>Streaming<br/>Accounts</h3>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <div class="col">
                        <div class="category-card-container">
                            <div class="category-card">
                                <div class="img-box d-flex justify-content-center">
                                    <img src="<?=ROOT?>/assets/vectors/article-writing.png" alt="category image" width="100">
                                </div>
                                 <div class="content-box">
                                    <h3>Article Writing<br/>Accounts</h3>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <div class="col">
                        <div class="category-card-container">
                            <div class="category-card">
                                <div class="img-box d-flex justify-content-center">
                                    <img src="<?=ROOT?>/assets/vectors/pen-writing.png" alt="category image" width="100">
                                </div>
                                 <div class="content-box">
                                    <h3>Academic Writing<br/>Accounts</h3>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <div class="col">
                        <div class="category-card-container">
                            <div class="category-card">
                                <div class="img-box d-flex justify-content-center">
                                    <img src="<?=ROOT?>/assets/vectors/transcription.png" alt="category image" width="100">
                                </div>
                                 <div class="content-box">
                                    <h3>Transcription<br/>Accounts</h3>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="font-oswold text-center">Latest Products</h3>
           <div id="products" class="container d-md-flex d-lg-flex justify-content-between mt-5 gap">
                <div class="product-card position-relative">
                    <div class="product-badge position-absolute px-2 py-2">
                        <button class="btn-new text-white">New</button>  
                    </div>
                    <img src="assets/vectors/netflix-product.png" class="img-fluid" alt="Product Image">
                    <div class="product-content">
                      <h5>Streaming</h5>
                      <h6 class="fs-700">Netflix</h6>
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
                          <span>500</span>
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
                  <div class="product-card position-relative">
                    <div class="product-badge position-absolute px-2 py-2">
                        <button class="btn-new text-white">New</button>  
                    </div>
                    <img src="assets/vectors/netflix-product.png" class="img-fluid" alt="Product Image">
                    <div class="product-content">
                      <h5>Streaming</h5>
                      <h6 class="fs-700">Netflix</h6>
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
                          <span>500</span>
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
                  <div class="product-card position-relative">
                    <div class="product-badge position-absolute px-2 py-2">
                        <button class="btn-new text-white">New</button>  
                    </div>
                    <img src="assets/vectors/netflix-product.png" class="img-fluid" alt="Product Image">
                    <div class="product-content">
                      <h5>Streaming</h5>
                      <h6 class="fs-700">Netflix</h6>
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
                          <span>500</span>
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
            </div>
    </main>
    <div class="circle-container">
    <div class="circle-wrap">
                <div class="circle">
                    <div class="mask half">
                        <div id="fill" class="fill"></div>
                    </div>
                    <div class="inside-circle"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
                          </svg>
                    </div>
                    <div class="mask full">
                        <div id="fill"></div>
                    </div>
                </div>
              </div>
    </div>
    <script src="<?=ROOT?>/assets/js/index.js"></script>
    <script src="<?=ROOT?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>