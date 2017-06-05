<?php

include "function.php";
include "connect.php";
include "header.php";

$_SESSION["current"] = 'index.php?college_id=' . $_GET["college_id"] . '&nonlatest=' . $_GET["nonlatest"];?>

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
                    $general_query = $db->prepare('SELECT (SUM(CASE WHEN lp.is_like = true THEN 1 ELSE 0 END)::float / 
                                  (CASE (SUM(CASE WHEN lp.is_like = true THEN 1 ELSE 0 END) + SUM(CASE WHEN lp.is_like = false THEN 1 ELSE 0 END)) 
                                    WHEN 0 
                                    THEN 1 
                                    ELSE (SUM(CASE WHEN lp.is_like = true THEN 1 ELSE 0 END) + SUM(CASE WHEN lp.is_like = false THEN 1 ELSE 0 END)) 
                                    END)::float) AS rating,
                                  p.post_id, p.content, p.college_id, p.sent_date, college.name
                                  FROM post p JOIN
                                  college ON p.college_id = college.college_id
                                  LEFT OUTER JOIN like_post lp
                                  ON p.post_id = lp.post_id                                  
                                  WHERE p.college_id = :college_id  
								  GROUP BY p.post_id, p.content, p.college_id, sent_date, college.name
                                  ORDER BY rating DESC');
                }
                else if ($_GET["nonlatest"] == 0)
                {
                    $general_query = $db->prepare('SELECT (SUM(CASE WHEN lp.is_like = true THEN 1 ELSE 0 END)::float / 
                                  (CASE (SUM(CASE WHEN lp.is_like = true THEN 1 ELSE 0 END) + SUM(CASE WHEN lp.is_like = false THEN 1 ELSE 0 END)) 
                                    WHEN 0 
                                    THEN 1 
                                    ELSE (SUM(CASE WHEN lp.is_like = true THEN 1 ELSE 0 END) + SUM(CASE WHEN lp.is_like = false THEN 1 ELSE 0 END)) 
                                    END)::float) AS rating,
                                  p.post_id, p.content, p.college_id, p.sent_date, college.name
                                  FROM post p JOIN
                                  college ON p.college_id = college.college_id
                                  LEFT OUTER JOIN like_post lp
                                  ON p.post_id = lp.post_id
                                  WHERE p.college_id = :college_id                                  
								  GROUP BY p.post_id, p.content, p.college_id, sent_date, college.name
                                  ORDER BY sent_date DESC');
                }

                $general_query->execute(array(':college_id' => $_GET["college_id"]));
            }
            else if ($_GET["college_id"] == 0)
            {
                if ($_GET["nonlatest"] == 1)
                {
                    $general_query = $db->prepare('SELECT (SUM(CASE WHEN lp.is_like = true THEN 1 ELSE 0 END)::float / 
                                  (CASE (SUM(CASE WHEN lp.is_like = true THEN 1 ELSE 0 END) + SUM(CASE WHEN lp.is_like = false THEN 1 ELSE 0 END)) 
                                    WHEN 0 
                                    THEN 1 
                                    ELSE (SUM(CASE WHEN lp.is_like = true THEN 1 ELSE 0 END) + SUM(CASE WHEN lp.is_like = false THEN 1 ELSE 0 END)) 
                                    END)::float) AS rating,
                                  p.post_id, p.content, p.college_id, p.sent_date, college.name
                                  FROM post p JOIN
                                  college ON p.college_id = college.college_id
                                  LEFT OUTER JOIN like_post lp
                                  ON p.post_id = lp.post_id
								  GROUP BY p.post_id, p.content, p.college_id, sent_date, college.name
                                  ORDER BY rating DESC');
                }
                else if ($_GET["nonlatest"] == 0)
                {
                    $general_query = $db->prepare('SELECT (SUM(CASE WHEN lp.is_like = true THEN 1 ELSE 0 END)::float / 
                                  (CASE (SUM(CASE WHEN lp.is_like = true THEN 1 ELSE 0 END) + SUM(CASE WHEN lp.is_like = false THEN 1 ELSE 0 END)) 
                                    WHEN 0 
                                    THEN 1 
                                    ELSE (SUM(CASE WHEN lp.is_like = true THEN 1 ELSE 0 END) + SUM(CASE WHEN lp.is_like = false THEN 1 ELSE 0 END)) 
                                    END)::float) AS rating,
                                  p.post_id, p.content, p.college_id, p.sent_date, college.name
                                  FROM post p JOIN
                                  college ON p.college_id = college.college_id
                                  LEFT OUTER JOIN like_post lp
                                  ON p.post_id = lp.post_id
								  GROUP BY p.post_id, p.content, p.college_id, sent_date, college.name
                                  ORDER BY sent_date DESC');

                    $general_query->execute();
                }

                $general_query->execute();
            }

            while ($row = $general_query->fetch(PDO::FETCH_ASSOC))
            {
                $results_av_query = '';
                $already_voted_query = '';

                if (isset($_SESSION["username"]))
                {
                    $already_voted_query = $db->prepare('SELECT EXISTS(SELECT  1 FROM like_post 
                                                                  WHERE post_id = :post_id
                                                                  AND user_id = :user_id) AS "exists"');

                    $already_voted_query->execute(array(':post_id' => $row['post_id'], ':user_id' => $_SESSION['user_id']));

                    $results_av_query = $already_voted_query->fetch(PDO::FETCH_ASSOC);
                }


                $num_comments_query = $db->prepare('SELECT coalesce(count(comment_id), 0) as num_comments FROM comment WHERE post_id = :post_id');
                $num_comments_query->execute(array(':post_id' => $row['post_id']));
                $num_comments_result = $num_comments_query->fetchColumn();
                $rating = round($row["rating"] * 100);
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
                              <a href="';
                              if (!(isset($_SESSION["username"])) || ($results_av_query["exists"] == true))
                              { echo '#'; }
                              else
                              { echo 'liking_loading.php?like=1&post_id=' . $row['post_id']; }
                               echo '" class="btn btn-success" ';
                            if (!(isset($_SESSION["username"]))) { echo 'data-toggle="tooltip" title="You must be logged in"'; }
                            if ($results_av_query["exists"] == true) {echo 'data-toggle="tooltip" title="You already voted"'; }
                echo '><span class="glyphicon glyphicon-thumbs-up"></span></a>
                              <a href="';
                              if (!(isset($_SESSION["username"])) || ($results_av_query["exists"] == true))
                              { echo '#'; }
                              else
                              { echo 'liking_loading.php?like=0&post_id=' . $row['post_id']; }
                               echo '" class="btn btn-danger" ';
                              if (!(isset($_SESSION["username"]))) { echo 'data-toggle="tooltip" title="You must be logged in"'; }
                              if ($results_av_query["exists"] == true) {echo 'data-toggle="tooltip" title="You already voted"'; }
                echo '><span class="glyphicon glyphicon-thumbs-down"></span></a></div>';

            echo'<a class="pull-right" href="comment.php?post_id=' . $row['post_id'] . '">' . $num_comments_result . ' Comments 
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
