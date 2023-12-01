<?php
  include '../app/pages/includes/access.php';
  access('ADMIN');

  $section  = $url[1] ?? 'dashboard';
  $action   = $url[2] ?? 'view';
  $id       = $url[3] ?? 0;

  $filename = "../app/pages/admin/".$section.".php";

  if($section == 'users')
  {
    require_once '../app/pages/admin/users-controller.php';
  }else
  if($section == 'categories')
  {
    require_once '../app/pages/admin/categories-controller.php';
  }else
  if($section == 'products')
  {
    require_once '../app/pages/admin/products-controller.php';
  }else
  if($section == 'blogs')
  {
    require_once '../app/pages/admin/blogs-controller.php';
  }else
  if($section == 'slides')
  {
    require_once '../app/pages/admin/slides-controller.php';
  }else
  if($section == 'sellers')
  {
    require_once '../app/pages/admin/sellers-controller.php';
  }

  if(!file_exists($filename))
  {
    require_once '../app/pages/admin/404.php';
    die;
  }

   
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard - Accounts Zone</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="<?=ROOT?>/assets/img/favicon.png" rel="icon">
  <link href="<?=ROOT?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="<?=ROOT?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=ROOT?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?=ROOT?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?=ROOT?>/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?=ROOT?>/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?=ROOT?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?=ROOT?>/assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="<?=ROOT?>/assets/css/style.css" rel="stylesheet">
  <link href="<?=ROOT?>/assets/css/admin.css" rel="stylesheet">
</head>

<body>
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="<?=ROOT?>/admin/dashboard" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">AccountsZone.</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->
      </ul>
    </nav>
  </header><!-- End Header -->
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link " href="<?=ROOT?>/admin/dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=ROOT?>/admin/users">
          <i class="bi bi-person"></i>
          <span>Users</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=ROOT?>/admin/categories">
        <i class="bi bi-bookmarks"></i>
          <span>Categories</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=ROOT?>/admin/products">
        <i class="bi bi-basket"></i>
          <span>Products</span>
        </a>
      </li><!-- End Profile Page Nav -->
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=ROOT?>/admin/blogs">
          <i class="bi bi-card-list"></i>
          <span>Blogs</span>
        </a>
      </li><!-- End Register Page Nav -->
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=ROOT?>/admin/sellers">
        <i class="bi bi-person"></i>
          <span>Sellers</span>
        </a>
      </li><!-- End Register Page Nav -->
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=ROOT?>/admin/slides">
        <i class="bi bi-card-image"></i>
          <span>Slides</span>
        </a>
      </li><!-- End Register Page Nav -->
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
        <a class="nav-link collapsed" href="<?=ROOT?>/admin/404">
          <i class="bi bi-dash-circle"></i>
          <span>Error 404</span>
        </a>
      </li><!-- End Error 404 Page Nav -->
    </ul>
  </aside><!-- End Sidebar-->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <?php
      require_once $filename;
    ?>
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Template Main JS File -->
  <script src="<?=ROOT?>/assets/js/main.js"></script>
</body>
</html>
