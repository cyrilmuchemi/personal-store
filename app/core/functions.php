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


function query(string $query, array $data = [])
{
    $string = "mysql:hostname=".DBHOST.";dbname=". DBNAME;
    $con = new PDO($string, DBUSER, DBPASS);
    $stm = $con->prepare($query);
    $stm->execute($data);

    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    if(is_array($result) && !empty($result))
    {
        return $result;
    }

    return false;
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


function redirect($page)
{
    header("Location: ".$page);
    die;
}

function old_value($key)
{
    if(!empty($_POST[$key]))
        return $_POST[$key];
    return "";
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


//create_tables();
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

        key username (username),
        key email (email)
    )";
    $stm = $con->prepare($query);
    $stm->execute();


}