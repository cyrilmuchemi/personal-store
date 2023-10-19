<?php

//create_tables();
function create_tables()
{
    $string = "mysql:hostname=DBHOST";
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
        password varchar(250) not null,
        date datetime default current_timestamp,

        key username (username),
        key email (email)
    )";
    $stm = $con->prepare($query);
    $stm->execute();


}