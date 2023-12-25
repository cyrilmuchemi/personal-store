<?php
session_start();
include_once(__DIR__ . '/init.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
            }
            
            else{
                $data['user_id'] = $_SESSION['myid'];
                $data['product_id'] = $_POST['product_id'];
                $data['quantity'] = 1;
        
                $query = 'INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)';
                $row = query($query, $data);
        
                if (!$row) {
                    http_response_code(500);
                    $info['error'] = "Error saving record!";
                    echo json_encode($info);
                    die;
                }      else {
                        $info['data'] = "Record was saved!";
                    }
            }
            
        }

        echo json_encode($info);

        
    }

    header('Content-Type: application/json');
?>
