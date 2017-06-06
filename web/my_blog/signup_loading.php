<?php

session_start();
include "connect.php";

$username = htmlspecialchars($_POST["username"]);
$password = password_hash(htmlspecialchars($_POST["pwd"]), PASSWORD_DEFAULT);
$email = htmlspecialchars($_POST["email"]);
$first_name = htmlspecialchars($_POST["first_name"]);
$last_name = htmlspecialchars($_POST["last_name"]);
$university = htmlspecialchars($_POST["university"]);
$prof_pic = htmlspecialchars($_POST["prof_pic"]);

$verify_query = $db->prepare('SELECT * FROM "user" WHERE username = :username');

$verify_query->execute(array(':username' => $username));

$num_users = $verify_query->rowCount();

if ($num_users > 0)
{
    $_SESSION["already_taken"] = true;
    header('Location: signup.php');
}
else
{
    $insert_query = $db->prepare('INSERT INTO "user"(username, password, email, first_name, last_name, college_id,
                                        profile_pic_url, registration_date) 
                                        VALUES
                                        (:username
                                        , :password
                                        , :email
                                        , :first_name
                                        , :last_name
                                        , :college_id
                                        , :profile_pic
                                        , now())');

    $insert_query->execute(array(':username' => $username, ':password' => $password, ':email' => $email
    , ':first_name' => $first_name
    , ':last_name' => $last_name
    , ':college_id' => $university
    , ':profile_pic' => $prof_pic));

    $_SESSION["already_taken"] = false;

    header('Location: signup_result.php');
}