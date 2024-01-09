<?php
session_start();
include_once(__DIR__ . '/init.php');

if(!empty($_POST))
{
    $data['cart_product_id'] = $_SESSION['cart_product_id'];
 
    $query_product = "SELECT * FROM products WHERE id = :cart_product_id LIMIT 1";
    $product_row = query_row($query_product, ['cart_product_id'=>$data['cart_product_id']]);

    $data['user_id'] = $_SESSION['myid'];

    $query_user = "SELECT * FROM users WHERE user_id = :user_id LIMIT 1";
    $user_row = query_row($query_user, ['user_id'=>$data['user_id']]);
    
    if(!empty($product_row) && !empty($user_row))
    {
        $data['username']           = $user_row['username'];
        $data['account_name']       = $product_row['name'];
        $data['user_email']         = $user_row['email'];
        $data['account_email']      = $product_row['owner_email'];
        $data['account_password']   = $product_row['owner_password'];
        $data['account_location']   = $product_row['account_location'];

        send_account_mail($data['username'], $data['user_email'], $data['account_name'], $data['account_email'], $data['account_password'], $data['account_location']);
        redirect('home');
        $_SESSION['account_sold'] = "Thank you for your Purchase! Account details are sent to your email";
    }else{
        $_SESSION['account_sold'] = "Purchase failed";
    }
}