<?php

session_start();
include "connect.php";

$comment_id = htmlspecialchars($_GET["comment_id"]);
$like = htmlspecialchars($_GET["like"]);

$insert_query = $db->prepare('INSERT INTO like_comment
                                                        (user_id, comment_id, is_like, like_date)
                                                        VALUES
                                                        (:user_id, :comment_id, :like , now());');
$insert_query->execute(array(':user_id' => $_SESSION["user_id"], ':comment_id' => $comment_id, ':like' => $like));

header('Location: '.$_SESSION["current"]);