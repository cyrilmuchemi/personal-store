<?php

if($action == 'add')
{
    if(!empty($_POST))
    {

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

        $data['caption'] = $_POST['caption'];
    
        if(!empty($destination))
        {
          $data['image'] = $destination;

        }   

        $query = "insert into slides (caption, image) values (:caption, :image)";
        query($query, $data);

        redirect('admin/slides');
    }
}else 
if($action == 'delete')
{
  $query= 'delete from slides where id = :id limit 1';
  $row = query_row($query, ['id'=>$id]);
 
  if($row){
  //validate
    $errors = [];
 
    if(empty($errors))
    {
          //delete from database
          $data = [];
          $data['id']     = $id;

        $query = "update slides set image = :image, caption = :caption";
        query($query, $data);

        redirect('admin/slides'); 
       }
    }
}