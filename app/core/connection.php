<?php

if($_SERVER['SERVER_NAME'] == 'localhost')
{
    define('DBUSER', "root");
    define('DBPASS', "");
    define('DBNAME', "accounts_zone");
    define('DBHOST', "localhost");
}else
{
    //setup online hosting details here
    define('DBUSER', "root");
    define('DBPASS', "");
    define('DBHOST', "localhost");
}



