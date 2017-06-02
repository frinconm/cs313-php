<?php

include "function.php";
include "connect.php";
include "header.php"; ?>

    <div class="row">
        <div class="col-xs-2"></div>
        <div class="col-xs-5">
            <?php
            $general_query = '';
            //All colleges
            if ($_GET["college_id"] != 0)
            {
                if ($_GET["nonlatest"] == 1)
                {
                    $general_query = $db->prepare('SELECT (p.likes::float / (CASE (p.likes + p.dislikes) WHEN 0 THEN 1 ELSE (p.likes + p.dislikes) END)::float) AS rating,
                                  post_id, content, p.college_id, likes, dislikes, sent_date, college.name
                                  FROM post p JOIN
                                  college ON p.college_id = college.college_id
                                  WHERE p.college_id = :college_id
                                  ORDER BY rating DESC');
                }
                else if ($_GET["nonlatest"] == 0)
                {
                    $general_query = $db->prepare('SELECT post_id, content, p.college_id, likes, dislikes, sent_date, college.name
                                  FROM post p JOIN
                                  college ON p.college_id = college.college_id
                                  WHERE p.college_id = :college_id
                                  ORDER BY sent_date DESC');
                }

                $general_query->execute(array(':college_id' => $_GET["college_id"]));
            }
            else if ($_GET["college_id"] == 0)
            {
                if ($_GET["nonlatest"] == 1)
                {
                    $general_query = $db->prepare('SELECT (p.likes::float / (CASE (p.likes + p.dislikes) WHEN 0 THEN 1 ELSE (p.likes + p.dislikes) END)::float) AS rating,
                                  post_id, content, p.college_id, likes, dislikes, sent_date, college.name
                                  FROM post p JOIN
                                  college ON p.college_id = college.college_id
                                  ORDER BY rating DESC');
                }
                else if ($_GET["nonlatest"] == 0)
                {
                    $general_query = $db->prepare('SELECT post_id, content, p.college_id, likes, dislikes, sent_date, college.name
                                  FROM post p JOIN
                                  college ON p.college_id = college.college_id
                                  ORDER BY sent_date DESC');
                    $general_query->execute();
                }

                $general_query->execute();
            }

            while ($row = $general_query->fetch(PDO::FETCH_ASSOC))
            {
                $num_comments_query = $db->prepare('SELECT coalesce(count(comment_id), 0) as num_comments FROM comment WHERE post_id = :post_id');
                $num_comments_query->execute(array((':post_id') => $row['post_id']));
                $num_comments_result = $num_comments_query->fetchColumn();
                $rating = round(($row['likes'] / ($row['likes'] + $row['dislikes'])) * 100);
                echo '<div class="panel panel-default">
                      <div class="panel-body"><span class="pull-right">' . $row['name']. '</span><br>' . $row['content'] .
                     '<div class="progress top-buffer-10 fixed-width-65">';
                if ($rating >= 50)
                {
                    echo '<div class="progress-bar progress-bar-success" ';
                }
                else
                {
                    echo '<div class="progress-bar progress-bar-danger" ';
                }
                echo 'role="progressbar" aria-valuenow="' . $rating . '"
                              aria-valuemin="0" aria-valuemax="100" style="width:' . $rating . '%">' .
                    $rating . '%
                              </div>
                          </div>
                          <div class="btn-group center-block" id="rating-block">
                              <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-thumbs-up"></span></button>
                              <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-thumbs-down"></span></button>
                            </div>
                          <a class="pull-right" href="comment.php?post_id=' . $row['post_id'] . '">' . $num_comments_result . ' Comments 
                          <span class="glyphicon glyphicon-comment"></span></a>
                      </div>
                      </div>';
            }
            ?>
        </div>
        <?php include 'universities.php' ?>
        <div class="col-xs-2"></div>
    </div>
    <div class="row">
        <div class="col-xs-3"></div>
        <div class="col-xs-4">
                <ul class="pagination">
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                </ul>
        </div>
        <div class="col-xs-3"></div>
        <div class="col-xs-2"></div>
    </div>
<?php include "footer.php" ?>
