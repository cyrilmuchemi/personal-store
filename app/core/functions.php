<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'assets/vendor/autoload.php';


function sendemail_verify($name, $email, $verify_token)
{
    $mail = new PHPMailer(true);

    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'ccntszone@gmail.com';                     //SMTP username
    $mail->Password   = 'dcuy lksd canu vvrm';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('ccntszone@gmail.com', $name);
    $mail->addAddress($email);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email verification from Accounts Zone';
    $mail->Body    = "
    <h2>You have registered with Accounts Zone</h2>
    <h5>Verify your Email address by clicking the link below!</h5>
    <a href='http://localhost/personal-store/public/verify-email?token=$verify_token'>Click Here</a>
    ";
    $mail->AltBody = "
    <h2>You have registered with Accounts Zone</h2>
    <h5>Verify your Email address by clicking the link below!</h5>
    <a href='http://localhost/personal-store/public/verify-email?token=$verify_token'>Click Here</a>
    ";
    

    $mail->send($email);

}

function query(string $query, array $data = [], $isUpdate = false)
{
    try {
        $string = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        $con = new PDO($string, DBUSER, DBPASS);
        $stm = $con->prepare($query);

        if ($isUpdate) {
            $stm->execute($data);
            return $stm->rowCount() > 0;
        } else {
            $stm->execute($data);
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}

function query_row(string $query, array $data = [])
{
    $string = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
    try {
        $con = new PDO($string, DBUSER, DBPASS);
        
        $stm = $con->prepare($query);
        $stm->execute($data);

        $result = $stm->fetch(PDO::FETCH_ASSOC);

        if (is_array($result) && !empty($result)) {
            return $result;
        } else {
            return false; 
        }
    } catch (PDOException $e) {
        echo "Database Error: " . $e->getMessage();
        return false;
    }
}

function str_to_url($url)
{

   $url = str_replace("'", "", $url);
   $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
   $url = trim($url, "-");
   $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
   $url = strtolower($url);
   $url = preg_replace('~[^-a-z0-9_]+~', '', $url);
   
   return $url;
}

function redirect($page)
{
    header('Location: '.ROOT. '/' . $page);

    die();
}

function old_value($key, $default = '')
{
    if(!empty($_POST[$key]))
        return $_POST[$key];
    return $default;
}

function old_checked($key)
{
    if(!empty($_POST[$key]))
        return " checked ";
    return "";
}

function authenticate($row)
{
    $_SESSION['USER'] = $row;
}

function logged_in()
{
    if(!empty($_SESSION['USER']))
        return true;

    return false;
}

function esc($str)
{
    return htmlspecialchars($str ?? '');
}

function get_pagination_vars()
{
    /* Set Pagination Variables */
    $page_number = $_GET['page'] ?? 1;
    $page_number = empty($page_number) ? 1 : (int)$page_number;
    $page_number = $page_number < 1 ? 1 : $page_number;

    $current_link =  $_GET['url'] ?? 'login';
    $current_link = ROOT.'/'.$current_link;
    $query_string = "";

    foreach($_GET as $key => $value)
    {
        if($key != 'url')
            $query_string .= "&".$key."=".$value;
    }

    if(!strstr($query_string, "page="))
    {
        $query_string .= "&page=".$page_number; 
    }

    $query_string = trim($query_string, "&");
    $current_link .=  "?". $query_string; 

    $current_link = preg_replace("/page=.*/", "page=".$page_number, $current_link);
    $next_link = preg_replace("/page=.*/", "page=".($page_number + 1), $current_link);
    $first_link = preg_replace("/page=.*/", "page=1", $current_link);
    $prev_page_number = $page_number < 2 ? 1 : $page_number - 1;
    $prev_link = preg_replace("/page=.*/", "page=".$prev_page_number, $current_link);

    $result = [
        'current_link' => $current_link,
        'next_link' => $next_link,
        'first_link' => $first_link,
        'prev_link' => $prev_link,
        'page_number' => $page_number
    ];

    return $result;
}

function resend_email_verify($name, $email, $verify_token)
{
    $mail = new PHPMailer(true);

    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'ccntszone@gmail.com';                     //SMTP username
    $mail->Password   = 'dcuy lksd canu vvrm';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('ccntszone@gmail.com', $name);
    $mail->addAddress($email);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Resend - Email verification from Accounts Zone';
    $mail->Body    = "
    <h2>You have registered with Accounts Zone</h2>
    <h5>Verify your Email address by clicking the link below!</h5>
    <a href='http://localhost/personal-store/public/verify-email?token=$verify_token'>Click Here</a>
    ";
    $mail->AltBody = "
    <h2>You have registered with Accounts Zone</h2>
    <h5>Verify your Email address by clicking the link below!</h5>
    <a href='http://localhost/personal-store/public/verify-email?token=$verify_token'>Click Here</a>
    ";
    
    $mail->send($email);
}

function create_user_id()
{
    $length = rand(4, 20);
    $number = "";

    for($i = 0; $i < $length; $i++)
    {
        $new_rand = rand(0, 9);
        $number = $number . $new_rand;
    }
    
    return $number;
}

function get_image($file)
{
    $file = $file ?? '';

    if (file_exists($file))
    {
        return ROOT.'/'.$file;
    }

    return ROOT.'/assets/vectors/no_image.png';
}

create_tables();
function create_tables()
{
    $string = "mysql:hostname=".DBHOST.";dbname=". DBNAME;
    $con = new PDO($string, DBUSER, DBPASS);

    $query = "create database if not exists ". DBNAME;
    $stm = $con->prepare($query);
    $stm->execute();

    $query = "use ". DBNAME;
    $stm = $con->prepare($query);
    $stm->execute();

    $query = "create table if not exists users(
        id int primary key auto_increment,
        username varchar(50) not null,
        email varchar(100) not null,
        phone varchar(15) not null,
        password varchar(255) not null,
        verify_token varchar(255) not null,
        verify_status tinyint(2) default 0 not null,
        date datetime default current_timestamp,
        role varchar(100) not null,
        user_id bigint not null,

        key username (username),
        key email (email)
    )";
    $stm = $con->prepare($query);
    $stm->execute();

         $query = "create table if not exists categories(
            id int primary key auto_increment,
            name varchar(100) not null,
            slug varchar(100) not null,
            image varchar(1024) null,
            status tinyint default 0,

            key slug (slug),
            key name (name)
        )";
        $stm = $con->prepare($query);
        $stm->execute();
    
}

function send_password_reset($get_name, $get_email, $token)
{
    $mail = new PHPMailer(true);

    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'ccntszone@gmail.com';                     //SMTP username
    $mail->Password   = 'dcuy lksd canu vvrm';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('ccntszone@gmail.com', $get_name);
    $mail->addAddress($get_email);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reset Password Notification';
    $mail->Body    = "
    <h2>Hello</h2>
    <h5>You are receivig this email because you requested a password reset for your account</h5>
    <a href='http://localhost/personal-store/public/password-change?token=$token&email=$get_email'>Click Here</a>
    ";
    $mail->AltBody = "
    <h2>Hello</h2>
    <h5>You are receivig this email because you requested a password reset for your account</h5>
    <a href='http://localhost/personal-store/public/password-change?token=$token&email=$get_email'>Click Here</a>
    ";
    
    $mail->send($get_email);
}
