<?php

if($action == 'add'){
    if(!empty($_POST)){
        $slug = str_to_url($_POST['account_name']);

        $query = "select id from products where slug = :slug limit 1";
        $slug_row = query($query, ['slug'=>$slug]);

        if($slug)
        {
            $slug .= rand(1000, 9999);
        }

        //validate image 
        $allowed = ['image/jpeg', 'image/png', 'image/webp'];
    
        if(!empty($_FILES['image']['name']))
        {
            $destination = "";
    
            if(!in_array($_FILES['image']['type'], $allowed))
            {
              $errors['image'] = "Image format not supported";
            }else
            {
              $folder = "uploads/";
              if(!file_exists($folder))
              {
                mkdir($folder, 0777, true);
              }
    
              $destination = $folder . time() . $_FILES['image']['name'];
              move_uploaded_file($_FILES['image']['tmp_name'], $destination);
              resize_image($destination);
            }
        }

        $data = [];
        $data['account_name'] = $_POST['account_name'];
        $data['category_id'] = $_POST['category_id'];
        $data['owner_email'] = $_POST['account_email'];
        $data['owner_password'] = $_POST['account_password'];
        $data['account_location'] = $_POST['account_location'];
        $data['account_metrics'] = $_POST['account_metrics'];
        $data['original_price'] = $_POST['account_old_price'];
        $data['selling_price'] = $_POST['account_new_price'];
        $data['small_description'] = $_POST['small_description'];
        $data['status'] = $_POST['status'];
        $data['sales'] = $_POST['sales'];
        $data['slug'] = $slug;

        if (!empty($destination)) {
            $data['image'] = $destination;
        }

        $query = "INSERT INTO products (name, slug, image, category_id, owner_email, owner_password, account_location, account_metrics, original_price, selling_price, small_description, status, sales) VALUES (:account_name, :slug, :image, :category_id, :owner_email, :owner_password, :account_location, :account_metrics, :original_price, :selling_price, :small_description, :status, :sales)";
        query($query, $data);

        redirect('admin/products');

    }
}else 
if($action == 'delete')
{
  $query= 'delete from products where id = :id limit 1';
  $row = query_row($query, ['id'=>$id]);
 
  if($row){
  //validate
    $errors = [];
 
    if(empty($errors))
    {
          //delete from database
          $data = [];
          $data['id']     = $id;

        $query = "update products set image = :image, name = :name";
        query($query, $data);

        redirect('admin/products'); 
       }
    }
}