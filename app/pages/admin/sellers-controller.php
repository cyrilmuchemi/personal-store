<?php

if($action == 'delete')
      {

        $query= 'delete from sellers where id = :id limit 1';
        $row = query_row($query, ['id'=>$id]);
       
        if($row)
        {
        //validate
          $errors = [];
       
          if(empty($errors))
          {
                //delete from database
                $data = [];
                $data['id']     = $id;

              $query = "update sellers set email = :email, role = :role where id = :id limit 1";
              query($query, $data);
          }
          redirect('admin/sellers'); 
        }
      }