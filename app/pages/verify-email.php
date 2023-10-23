<?php

if(isset($_GET['token']))
{
    $token = $_GET['token'];
    $query = "select verify_token, verify_status from users where verify_token='$token' limit 1";
    $row = query_row($query);

    if($row)
    {
        $verify_token = $row['verify_token'];


        if($row['verify_status'] === 0)
        {
            $clicked_token = $verify_token;
            $update_query = "update users set verify_status = 1 where verify_token='$clicked_token' limit 1";
            $update_status = query_row($update_query);

            $_SESSION['status'] = "Verification Successful. Please login";
            redirect('login');
            exit(0);
        } else 
        {
            $_SESSION['status'] = "Email has already been verified";
            redirect('login');
            exit(0);
         }

    }else{
        $_SESSION['status'] = "Token does not exist";
        redirect('login');
    }
}else
{
    $_SESSION['status'] = "Access denied";
    redirect('login');
}

?>