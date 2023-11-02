<?php

if($action == 'add')
{
    if(!empty($_POST))
    {
        $slug = str_to_url($_POST['category_name']);

        $query = "select id from categories where slug = :slug limit 1";
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

        $data['name'] = $_POST['category_name'];
        $data['slug']    = $slug;
    
        if(!empty($destination))
        {
          $data['image'] = $destination;

        }   

        $query = "insert into categories (name, slug, image) values (:name, :slug, :image)";
        query($query, $data);

        redirect('admin/categories');
    }
}else 
if($action == 'delete')
{
  $query= 'delete from categories where id = :id limit 1';
  $row = query_row($query, ['id'=>$id]);
 
  if($row){
  //validate
    $errors = [];
 
    if(empty($errors))
    {
          //delete from database
          $data = [];
          $data['id']     = $id;

        $query = "update categories set image = :image, name = :name";
        query($query, $data);

        redirect('admin/categories'); 
       }
    }
}