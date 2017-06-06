<?php

session_start();

include "connect.php";

$_SESSION["wrong"] = false;

$username = htmlspecialchars($_POST["username"]);
$password = htmlspecialchars($_POST["pwd"]);

$login_query = $db->prepare('SELECT "user".user_id, "user".username, "user".first_name, "user".last_name, "user".profile_pic_url, "user".password  
                                      FROM "user" WHERE "user".username = :username');

$login_query->execute(array(':username' => $username));
$row = $login_query->fetch(PDO::FETCH_ASSOC);

if (password_verify($password, $row["password"]))
{
    $_SESSION["user_id"] = $row["user_id"];
    $_SESSION["first_name"] = $row["first_name"];
    $_SESSION["last_name"] = $row["last_name"];
    $_SESSION["username"] = $row["username"];
    $_SESSION["profile_pic_url"] = $row["profile_pic_url"];

    header('Location: index.php?college_id=' . $_GET["college_id"] . '&nonlatest=' . $_GET["nonlatest"] . '&page=' . $_GET["page"]);
    die();
}
else
{
    $_SESSION["wrong"] = true;
    header('Location: index.php?college_id=' . $_GET["college_id"] . '&nonlatest=' . $_GET["nonlatest"] . '&page=' . $_GET["page"]);
    die();
}
