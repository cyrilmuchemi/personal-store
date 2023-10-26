<?php

if(isset($_SESSION['username']))
{
    unset($_SESSION['username']);
}

if(isset($_SESSION['myid']))
{
    unset($_SESSION['myid']);
}

if(isset($_SESSION['myrole']))
{
    unset($_SESSION['myrole']);
}

if(isset($_SESSION["ACCESS"]))
{
    unset($_SESSION["ACCESS"]);
}

redirect('login');

