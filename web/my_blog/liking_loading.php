<?php

session_start();
include "connect.php";

$post_id = htmlspecialchars($_GET["post_id"]);
$like = htmlspecialchars($_GET["like"]);

$insert_query = $db->prepare('INSERT INTO like_post
                                                        (user_id, post_id, is_like, like_date)
                                                        VALUES
                                                        (:user_id, :post_id, :like , now());');
$insert_query->execute(array(':user_id' => $_SESSION["user_id"], ':post_id' => $post_id, ':like' => $like));

header('Location: '.$_SESSION["current"]);