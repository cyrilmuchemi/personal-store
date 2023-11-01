<?php

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

        $query = "select id from users where email = :email && id != :id limit 1";
        $email = query($query, ['email' => $_POST['email'], 'id'=>$id]);

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

            redirect('admin/users');
        }
      } 
    }else
      if($action == 'edit')
      {
        $query = "select * from users where id = :id limit 1";
        $row = query_row($query, ['id'=>$id]);
        if(!empty($_POST))
        {
          if($row){
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

                $data = [];
                $data['username'] = $_POST['username'];
                $data['email'] = $_POST['email'];
                $data['phone'] = $_POST['phone'];
                $data['role'] = $row['role'];
                $data['id'] = $id;

                if(empty($_POST['password']))
                {
                  $query = "update users set username = :username, email = :email, phone = :phone, role = :role where id = :id limit 1";
                }else
                {
                  $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                  $query = "update users set username = :username, email = :email, phone = :phone, password = :password, role = :role where id = :id limit 1";
                }

                redirect('admin/users');
            }
          } 
        }
      }else
      if($action == 'delete')
      {

        $query= 'delete from users where id = :id limit 1';
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

              $query = "update users set username = :username, email = :email, role = :role where id = :id limit 1";
              query($query, $data);
          }
          redirect('admin/users'); 
        }
      }
