<?php

session_start();
include "connect.php";

$secret_content = htmlspecialchars($_POST["secret_content"]);
$university = htmlspecialchars($_POST["university"]);

$insert_query = $db->prepare('INSERT INTO post(content, college_id, sent_date) 
                                        VALUES
                                        (:secret_content
                                        , :college_id
                                        , now())');

$insert_query->execute(array(':secret_content' => $secret_content, ':college_id' => $university));

header('Location: post_sent.php');