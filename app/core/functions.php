<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../public/assets/vendor/autoload.php';


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

function query(string $query, array $data = [], bool $isUpdate = false)
{
    try {
        $string = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        $con = new PDO($string, DBUSER, DBPASS);

        $stm = $con->prepare($query);

        foreach ($data as $key => &$value) {
            $paramName = is_int($key) ? $key + 1 : ":$key";

            if (is_array($value)) {
                // Handle array parameters
                foreach ($value as $index => $item) {
                    $arrayParamName = "{$key}_{$index}";
                    $stm->bindValue(":$arrayParamName", $item);
                }
                unset($data[$key]); // Remove the original array parameter from $data
            } else {
                $stm->bindValue($paramName, $value);
            }
        }

        if ($isUpdate) {
            $success = $stm->execute();
            return $success && $stm->rowCount() > 0;
        } else {
            $success = $stm->execute();

            if (!$success) {
                // Handle query execution failure
                return false;
            }

            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    } catch (PDOException $e) {
        // Log the error or handle it appropriately
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
        echo "SQL Error: " . $e->getMessage();
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

function get_pagination_vars() {
    $page_number = $_GET['page'] ?? 1;
    $page_number = empty($page_number) ? 1 : (int) $page_number;
    $page_number = $page_number < 1 ? 1 : $page_number;

    $current_link = $_GET['url'] ?? 'login';
    $current_link = ROOT . '/' . $current_link;
    $query_string = "";

    foreach ($_GET as $key => $value) {
        if ($key !== 'url' && $key !== 'page') {
            if (!is_array($value)) {
                $query_string .= "&" . $key . "=" . $value;
            } else {
                // Handle array values if needed
            }
        }
    }

    if (!strstr($query_string, "page=")) {
        $query_string .= "&page=" . $page_number;
    }

    $query_string = trim($query_string, "&");
    $current_link .= "?" . $query_string;

    $current_link = preg_replace("/page=.*/", "page=" . $page_number, $current_link);
    $next_link = preg_replace("/page=.*/", "page=" . ($page_number + 1), $current_link);
    $first_link = preg_replace("/page=.*/", "", $current_link);  // Remove page parameter for the first page link
    $prev_page_number = $page_number < 2 ? 1 : $page_number - 1;
    $prev_link = preg_replace("/page=.*/", "page=" . $prev_page_number, $current_link);

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

function old_select($key, $value, $default = "")
{
    if(!empty($_POST[$key]) && $_POST[$key] == $value)
        return " selected ";

    if($default == $value)
        return "selected";

    return "";
}

function get_image($file)
{

    if (file_exists($file))
    {
        return ROOT.'/'.$file;
    }else
    {
        return ROOT.'/assets/vectors/no_image.png';
    }
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

        $query = "create table if not exists products(
            id int primary key auto_increment,
            category_id int not null,
            name varchar(150) not null,
            slug varchar(200) not null,
            small_description text not null,
            description text not null,
            original_price int not null,
            selling_price int not null,
            image varchar(250) not null,
            status tinyint(4) not null,
            trending tinyint(4) not null,
            meta_title varchar(200) not null,
            meta_keywords text not null,
            date datetime default current_timestamp,

            key slug (slug),
            key name (name)
        )";
        $stm = $con->prepare($query);
        $stm->execute();

        $query = "create table if not exists blogs(
            id int primary key auto_increment,
            image varchar(250) not null,
            title text not null,
            content text not null,
            date datetime default current_timestamp,

            key title (title)
        )";
        $stm = $con->prepare($query);
        $stm->execute();

        $query = "create table if not exists slides(
            id int primary key auto_increment,
            image varchar(250) not null,
            caption varchar(100) not null,
            date datetime default current_timestamp,

            key image (image)
        )";
        $stm = $con->prepare($query);
        $stm->execute();

        $query = "create table if not exists sellers(
            id int primary key auto_increment,
            email varchar(100) not null,
            phone varchar(15) not null,
            date datetime default current_timestamp,
            role varchar(100) not null,
            account_name varchar(200) not null,
            account_price int not null,
    
            key phone (phone),
            key email (email)
        )";
        $stm = $con->prepare($query);
        $stm->execute();

        $query = "create table if not exists cart(
            id int primary key auto_increment,
            user_id varchar(100) not null,
            product_id varchar(100) not null,
            quantity int not null,
            created_at datetime default current_timestamp,

            key user_id (user_id),
            key product_id (product_id)
        )";

        $stm = $con->prepare($query);
        $stm->execute();
}

function remove_images_from_content($content, $folder = 'uploads/')
{

	preg_match_all("/<img[^>]+/", $content, $matches);

	if(is_array($matches[0]) && count($matches[0]) > 0)
	{
		foreach ($matches[0] as $img) {

			if(!strstr($img, "data:"))
			{
				continue;
			}

			preg_match('/src="[^"]+/', $img, $match);
			$parts = explode("base64,", $match[0]);

			preg_match('/data-filename="[^"]+/', $img, $file_match);

			$filename = $folder.str_replace('data-filename="', "", $file_match[0]);

			file_put_contents($filename, base64_decode($parts[1]));
			$content = str_replace($match[0], 'src="'.$filename, $content);
			

		}
	}
	return $content;
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

function getMIMETypeByExtension($filename) {
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    $mimeTypes = [
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'pdf' => 'application/pdf',
    ];

    $defaultMimeType = 'application/octet-stream';

    if (array_key_exists($extension, $mimeTypes)) {
        return $mimeTypes[$extension];
    } else {
        return $defaultMimeType;
    }
}


function getMIMEType($filename) {
    if (class_exists('finfo')) {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime_type = $finfo->file($filename);
        return $mime_type;
    } else {
        return getMIMETypeByExtension($filename);
    }
}


function resize_image($filename, $max_size = 1000)
{
	
	if(file_exists($filename))
	{
        $type = getMIMEType($filename);

		switch ($type) {
			case 'image/jpeg':
				$image = imagecreatefromjpeg($filename);
				break;
			case 'image/png':
				$image = imagecreatefrompng($filename);
				break;
			case 'image/gif':
				$image = imagecreatefromgif($filename);
				break;
			case 'image/webp':
				$image = imagecreatefromwebp($filename);
				break;
			default:
				return;
				break;
		}

		$src_width 	= imagesx($image);
		$src_height = imagesy($image);

		if($src_width > $src_height)
		{
			if($src_width < $max_size)
			{
				$max_size = $src_width;
			}

			$dst_width 	= $max_size;
			$dst_height = ($src_height / $src_width) * $max_size;
		}else{
			
			if($src_height < $max_size)
			{
				$max_size = $src_height;
			}

			$dst_height = $max_size;
			$dst_width 	= ($src_width / $src_height) * $max_size;
		}

		$dst_height = round($dst_height);
		$dst_width 	= round($dst_width);

		$dst_image = imagecreatetruecolor($dst_width, $dst_height);
		imagecopyresampled($dst_image, $image, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
		
		switch ($type) {
			case 'image/jpeg':
				imagejpeg($dst_image, $filename, 90);
				break;
			case 'image/png':
				imagepng($dst_image, $filename, 90);
				break;
			case 'image/gif':
				imagegif($dst_image, $filename, 90);
				break;
			case 'image/webp':
				imagewebp($dst_image, $filename, 90);
				break;

		}

	}
}
