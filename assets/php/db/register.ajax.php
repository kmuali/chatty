<?php

require_once "ChattyPDO.php";
require_once "user.php";

function isName($value)
{
    return preg_match("/^[a-zA-Z\s]+$/", trim($value));
}

function isUsername($value)
{
    return preg_match("/^[a-zA-Z\d\.]+$/", trim($value));
}

function isUsedUsername($value)
{
    $pdo = new ChattyPDO();
    return $pdo->existsUsername($value);
}

function isEmail($value)
{
    return !trim($value) || preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", trim($value));
}

function isPassword($value)
{
    return strlen($value) >= 8;
}

if ($_POST["q"] == "1") {
    try {
        $__username = trim($_POST["username"]);
        $__firstName = trim($_POST["firstName"]);
        $__familyName = trim($_POST["familyName"]);
        $__pass = $_POST["pass"];
        $__email = trim($_POST["email"]);
        $__gender = $_POST["gender"];
        $__dob = $_POST["dob"];
        $isRegistered = (isName($__firstName) && isName($__familyName) && isUsername($__username) && !isUsedUsername($__username) &&
            isPassword($__pass) && isEmail($__email) && $__gender && $__dob);
        if ($isRegistered) {
            $pdo = new ChattyPDO();
            echo $pdo->insertUser($__username, password_hash($__pass, PASSWORD_DEFAULT), $__firstName, $__familyName, $__email, $__gender, $__dob);
            logUserIn($pdo->getUserIdByUsername($__username));
        } else {
            echo "register.ajax.php rejected submission";
        }
    } catch (\Throwable $th) {
        echo $th;
    }
} else {

    foreach ($_POST as $key => $value) {
        echo $key . "$";
        if (($key == "firstName" || $key == "familyName") && !isName($value)) echo 'Not in English letters';
        elseif ($key == "username" && isUsedUsername($value)) echo "$value is used or is not available";
        elseif ($key == "username" && !isUsername($value)) echo "Contains a special character other than dots";
        elseif ($key == "email" && !isEmail($value)) echo "Not a valid email address";
        elseif ($key == "gender" && !$value) echo "Must select a gender";
        elseif ($key == "dob" && !$value) echo "Must select a date of birth";
        elseif ($key == "pass" && !isPassword($value)) echo "Must consists of 8 characters or more";
        elseif ($key == "rePass" && $value != $_POST["z"]) echo "Passwords do not match";
        break;
    }
}
