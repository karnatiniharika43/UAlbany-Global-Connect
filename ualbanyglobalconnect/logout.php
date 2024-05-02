<?php 

session_start();

if(isset($_SESSION['ualbanyglobalconnect_userid']));
{
    $_SESSION['ualbanyglobalconnect_userid'] = NULL;
    unset($_SESSION['ualbanyglobalconnect_userid']);
}

header("Location: login.php");
die;