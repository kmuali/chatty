<?php

function logUserIn($id, $daysCount = 1)
{
    setcookie("chattyUserId", $id, time() + (86400 * 30 * $daysCount), "/");
}

function logUserOut()
{
    setcookie("chattyUserId", "", PHP_INT_MAX,  "/");
}

function isUserLoggedIn()
{
    return $_COOKIE["chattyUserId"];
}

if (key_exists("logUserOut", $_GET)) {
    logUserOut();
    header("Location: ../../../" . $_GET["logUserOut"]);
    die();
}
