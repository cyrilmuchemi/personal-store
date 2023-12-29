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
    
            $info['data'] = is_array($result) ? $result : []; 

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
        
                // Fetch existing quantity from the cart for the specified product
                $quantityQuery = 'SELECT quantity FROM cart WHERE user_id = :user_id AND product_id = :product_id';
                $existingQuantity = query_row($quantityQuery, $data);
        
                // If the product is already in the cart, increment the quantity
                if ($existingQuantity !== false) {
                    $data['quantity'] = $existingQuantity + 1;
                } else {
                    // If the product is not in the cart, set quantity to 1
                    $data['quantity'] = 1;
                }
        
                // Fetch product details (price and image) separately
                $query_product = "SELECT products.* FROM products WHERE id = :product_id";
                $product_row = query_row($query_product, ['product_id' => $data['product_id']]);
        
                if ($product_row) {
                    $data['price'] = $product_row['selling_price'];
                    $data['image'] = $product_row['image'];
                    $data['cart_item'] = $product_row['name'];
                }
        
              // Use a conditional INSERT to handle existing records
                    $query = 'INSERT INTO cart (user_id, product_id, quantity, price, image, cart_item) 
                    VALUES (:user_id, :product_id, :quantity, :price, :image, :cart_item)
                    ON DUPLICATE KEY UPDATE quantity = :quantity, price = :price, image = :image, cart_item = :cart_item';

                    $inserted = query($query, $data);

        
                if (!$inserted) {
                    http_response_code(500);
                    $info['error'] = "Error saving or updating record!";
                    echo json_encode($info);
                    exit();
                }
        
            }
        
        }else
        if ($_POST['data_type'] == 'delete') {

            try {
                $id = (int)$_POST['id'];
                $query = "DELETE FROM cart WHERE id = $id LIMIT 1";
                $delete_row = query($query);

            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['data_type' => 'error', 'error' => 'Server error: ' . $e->getMessage()]);
                exit();
            }
    
        }
        echo json_encode($info);
        exit();
        
    }

?>
