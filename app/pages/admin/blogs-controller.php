<?php

if($action == 'add'){
    if(!empty($_POST)){

      $slug = str_to_url($_POST['title']);

      $query = "select id from blogs where slug = :slug limit 1";
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

        $new_content = remove_images_from_content($_POST['content']);

        $data = [];
        $data['title'] = $_POST['title'];
        $data['content'] = $new_content;
        $data['slug'] = $slug;


        if (!empty($destination)) {
            $data['image'] = $destination;
        }

        $query = "INSERT INTO blogs (title, image, content, slug) VALUES (:title, :image, :content, :slug)";
        query($query, $data);

        redirect('admin/blogs');

    }
}else 
if($action == 'delete')
{
  $query= 'delete from blogs where id = :id limit 1';
  $row = query_row($query, ['id'=>$id]);
 
  if($row){
  //validate
    $errors = [];
 
    if(empty($errors))
    {
          //delete from database
          $data = [];
          $data['id']     = $id;

        $query = "update blogs set image = :image, title = :title";
        query($query, $data);

        redirect('admin/blogs'); 
       }
    }
}