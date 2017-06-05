<?php

session_start();
include "connect.php";

$_SESSION["wrong"] = false;

$username = htmlspecialchars($_POST["username"]);
$password = htmlspecialchars($_POST["pwd"]);

$login_query = $db->prepare('SELECT "user".user_id, "user".username, "user".first_name, "user".last_name, "user".profile_pic_url  
                                      FROM "user" WHERE "user".username = :username AND "user".password = :password');

$login_query->execute(array(':username' => $username, ':password' => $password));

if ($login_query->rowCount() > 0)
{
    $row = $login_query->fetch(PDO::FETCH_ASSOC);

    $_SESSION["user_id"] = $row["user_id"];
    $_SESSION["first_name"] = $row["first_name"];
    $_SESSION["last_name"] = $row["last_name"];
    $_SESSION["username"] = $row["username"];
    $_SESSION["profile_pic_url"] = $row["profile_pic_url"];

    header('Location: '.$_SESSION["current"]);
}
else
{
    $_SESSION["wrong"] = true;
    header('Location: '.$_SESSION["current"]);
}
