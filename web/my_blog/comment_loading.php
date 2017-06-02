<?php

session_start();
include "connect.php";

$comment_content = htmlspecialchars($_POST["comment"]);
$username = htmlspecialchars($_SESSION["username"]);

$insert_query = $db->prepare('INSERT INTO comment
                                        (user_id, post_id, content, likes, dislikes, sent_date)
                                        VALUES
                                        ((SELECT user_id FROM "user" WHERE "user".username = :username )
                                        , :post_id
                                        , :content
                                        , 0
                                        , 0
                                        , CURRENT_DATE);');

$insert_query->execute(array(':username' => $username, ':post_id' => $_POST["post_id"], ':content' => $comment_content));

header('Location: comment.php?post_id=' . $_POST["post_id"]);