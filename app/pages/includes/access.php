<?php

function access($role)
{

    if(isset($_SESSION["ACCESS"]) && !$_SESSION['ACCESS'][$role])
    {
        redirect('access-denied');
        die;
    }
    
}

$_SESSION["ACCESS"]["ADMIN"] = isset($_SESSION['myrole']) && (trim($_SESSION['myrole']) === "admin" || isset($_SESSION['myrole']) && trim($_SESSION['myrole']) === "editor");

$_SESSION["ACCESS"]["CUSTOMER"] = isset($_SESSION['myrole']) && trim($_SESSION['myrole']) === "customer";

$_SESSION["ACCESS"]["EDITOR"] = isset($_SESSION['myrole']) && trim($_SESSION['myrole']) === "editor";

$_SESSION["ACCESS"]["SELLER"] = isset($_SESSION['myrole']) && trim($_SESSION['myrole']) === "seller";

