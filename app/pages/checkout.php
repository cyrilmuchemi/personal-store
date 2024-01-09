<?php
  include '../app/pages/includes/access.php';
  access('CUSTOMER');

  $data['cart_product'] = $_SESSION['cart_product'];
 
  $query_product = "SELECT * FROM products WHERE name = :cart_product";
  $product_row = query_row($query_product, $data);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lipa na mpesa</title>
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link href="" rel="stylesheet" />
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" ">
    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"
    ></script>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap");

      body {
        background-color: #eaedf4;
        font-family: "Rubik", sans-serif;
      }

      .card {
        width: 310px;
        border: none;
        border-radius: 15px;
      }

      .justify-content-around div {
        border: none;
        border-radius: 20px;
        background: #f3f4f6;
        padding: 5px 20px 5px;
        color: #8d9297;
      }

      .justify-content-around span {
        font-size: 12px;
      }

      .justify-content-around div:hover {
        background: #545ebd;
        color: #fff;
        cursor: pointer;
      }

      .justify-content-around div:nth-child(1) {
        background: #545ebd;
        color: #fff;
      }

      span.mt-0 {
        color: #8d9297;
        font-size: 12px;
      }

      h6 {
        font-size: 15px;
      }
      .mpesa {
        background-color: green !important;
      }

      img {
        border-radius: 15px;
      }
    </style>
  </head>
  <body oncontextmenu="return false" class="snippet-body">
    <div class="container d-flex justify-content-center">
      <div class="card mt-5 px-3 py-4">
        <div class="d-flex flex-row justify-content-around">
          <div class="mpesa"><span>Mpesa </span></div>
        </div>
        <div class="media mt-4 d-flex justify-content-center pl-2">
          <img src="<?=ROOT?>/assets/vectors/Mpepe.png" class="mr-3" height="75" />
            <h6>Enter Phone Number</h6>
        </div>
        <div class="media mt-3 pl-2">
            <!--bs5 input-->
            <?php if(!empty($product_row)): ?>
            <form class="row g-3" action="/personal-store/app/core/sendProduct.php" method="POST">
                <div class="col-12">
                  <label for="inputAddress" class="form-label">Amount</label>
                  <input type="text" class="form-control" name="amount" value="<?=$product_row['selling_price']?>" disabled>
                </div>
                <div class="col-12">
                  <label for="inputAddress2" class="form-label" >Phone Number</label>
                  <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number">
                </div>
             
                <div class="col-12">
                  <button type="submit" id="mpepe" class="btn btn-success" name="submit" value="submit">Buy Account</button>
                </div>
              </form>
              <?php endif ;?>
              <!--bs5 input-->
          </div>
        </div>
      </div>
    </div>
    
    <script
      type="text/javascript"
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"
    ></script>
  </body>
</html>