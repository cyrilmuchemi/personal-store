<?php
session_start();
error_reporting(E_ALL);
include_once(__DIR__ . '/init.php');
ini_set('display_errors', 1);

header('Content-Type: application/json');

    if(count($_POST) > 0)
    {
        $info = [];
        $info['data_type'] = $_POST['data_type'];

        if ($_POST['data_type'] == 'read') {
            $query = "select * from cart order by id desc limit 1";
            $result = query($query);
    
            $info['data'] = $result;
        }else
        if ($_POST['data_type'] == 'save') {
            $data = [];
        
            if (empty($_SESSION['myid'])) {
                http_response_code(401);
                echo json_encode(['error' => 'User is not authenticated']);
                exit();
            } else {
                $data['product_id'] = $_POST['product_id'];
                $data['user_id'] = $_SESSION['myid'];
                $data['quantity'] = 1;
        
                // Use a conditional INSERT to handle existing records
                $query = 'INSERT INTO cart (user_id, product_id, quantity, price, image) 
                          VALUES (:user_id, :product_id, :quantity, :price, :image)
                          ON DUPLICATE KEY UPDATE quantity = quantity + 1, price = :price, image = :image';
        
                // Fetch product details (price and image) separately
                $query_product = "SELECT products.* FROM cart JOIN products ON cart.product_id = products.id WHERE cart.product_id = :product_id";
                $product_row = query_row($query_product, ['product_id' => $data['product_id']]);
        
                if ($product_row) {
                    $data['price'] = $product_row['selling_price'];
                    $data['image'] = $product_row['image'];
                }
        
                $inserted = query($query, $data);
        
                if (!$inserted) {
                    http_response_code(500);
                    $info['error'] = "Error saving or updating record!";
                    echo json_encode($info);
                    exit();
                }
        
            }
        }

        echo json_encode($info);
        exit();
        
    }

?>
