<?php
  include '../app/pages/includes/access.php';
  access('ADMIN');

  $section = $url[1] ?? 'dashboard';
  $filename = "../app/pages/admin/".$section.".php";

  if(file_exists($filename))
  {
    require_once $filename;
  }

?>
