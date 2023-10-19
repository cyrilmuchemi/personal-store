<?php

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
        date datetime default current_timestamp,

        key username (username),
        key email (email)
    )";
    $stm = $con->prepare($query);
    $stm->execute();


}