<?php

session_start();
include "connect.php";

$username = htmlspecialchars($_POST["username"]);
$password = htmlspecialchars($_POST["pwd"]);
$email = htmlspecialchars($_POST["email"]);
$first_name = htmlspecialchars($_POST["first_name"]);
$last_name = htmlspecialchars($_POST["last_name"]);
$university = htmlspecialchars($_POST["university"]);
$prof_pic = htmlspecialchars($_POST["prof_pic"]);

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
                                        , CURRENT_DATE)');

$insert_query->execute(array(':username' => $username, ':password' => $password, ':email' => $email
                                        , ':first_name' => $first_name
                                        , ':last_name' => $last_name
                                        , ':college_id' => $university
                                        , ':profile_pic' => $prof_pic));

header('Location: signup_result.php');