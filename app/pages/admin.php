<?php
  include '../app/pages/includes/access.php';
  access('ADMIN');

  $section  = $url[1] ?? 'dashboard';
  $action   = $url[2] ?? 'view';

  $filename = "../app/pages/admin/".$section.".php";

  if(!file_exists($filename))
  {
    require_once '../app/pages/admin/404.php';
    die;
  }

    if($action == 'add')
    {
      if(!empty($_POST))
      {

        //validate
        $errors = [];

        $query = "select id from users where username = :username limit 1";
        $username = query($query, ['username' => $_POST['username']]);

        if(empty($_POST['username']))
        {
            $errors['username'] = "Please enter your username!";

        }else
        if(!preg_match("/^[0-9a-zA-Z]{2,23}+$/", $_POST['username']))
        {
            $errors['username'] = "Username can only contain numbers and letters!";
        }else
        if($username)
        {
            $errors['username'] = "Username already exists";
        }

        $query = "select id from users where email = :email limit 1";
        $email = query($query, ['email' => $_POST['email']]);

        if(empty($_POST['email']))
        {
            $errors['email'] = "Please enter your email!";
        }else
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
          $errors['email'] = "Email not valid";
        }else
        if($email)
        {
            $errors['email'] = "That email already exists";
        }

        $query = "select id from users where phone = :phone limit 1";
        $phone = query($query, ['phone' => $_POST['phone']]);

        if(empty($_POST['phone']))
        {
            $errors['phone'] = "Please enter your phone number!";
        }else
        if($phone)
        {
            $errors['phone'] = "That phone number is in use!";
        }


        if(empty($_POST['password']))
          {
              $errors['password'] = "Please enter your password!";
          }else if (strlen($_POST['password']) < 8)
          {
              $errors['password'] = "Password must be 8 characters or more";
          }else if(!preg_match("/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#\$%])[0-9a-zA-Z!@#\$%]+$/", $_POST['password']))
          {
              $errors['password'] = "Password must contain numbers, letters, and special characters";
          }else if($_POST['password'] !== $_POST['confirmpassword'])
          {
              $errors['confirmpassword'] = "Passwords do not match!";
          }


        if(empty($errors))
        {
            $_POST['user_id'] = create_user_id();
            $user_query = 'select id from users where user_id = :user_id limit 1';
            $user_id = query($user_query, ['user_id' => $_POST['user_id']]);

            $data = [];
            $data['username'] = $_POST['username'];
            $data['email'] = $_POST['email'];
            $data['phone'] = $_POST['phone'];
            $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $data['verify_token'] = md5(rand());
            $data['role'] = $_POST['role'];

            if(!$user_id)
            {
                $data['user_id'] = $_POST['user_id'];
            }
            
            $query = "insert into users (username, email, phone, password, verify_token, role, user_id) values (:username, :email, :phone, :password, :verify_token, :role, :user_id)";
            query($query, $data);

            echo $query;

            redirect('admin/users');
        }
    }
     
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
        <a class="nav-link collapsed" href="users-profile.html">
        <a class="nav-link collapsed" href="<?=ROOT?>/admin/users">
          <i class="bi bi-person"></i>
          <span>Users</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=ROOT?>/admin/categories">
          <i class="bi bi-card-list"></i>
          <span>Categories</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=ROOT?>/admin/products">
          <i class="bi bi-card-list"></i>
          <span>Products</span>
        </a>
      </li><!-- End Profile Page Nav -->
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=ROOT?>/admin/add-user">
        <a class="nav-link collapsed" href="<?=ROOT?>/admin/blogs">
          <i class="bi bi-card-list"></i>
          <span>Blogs</span>
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
