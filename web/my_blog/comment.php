<?php

include "function.php";
include "connect.php";
include "header.php";

if ($_GET["page"] == 0)
{
    $_GET["page"] = 1;
}

$_SESSION["current"] = 'comment.php?post_id=' . $_GET['post_id'] . '&page=' . $_GET["page"]; ?>

    <div class="row">
        <div class="col-xs-2"></div>
        <div class="col-xs-5">
            <?php
            //All colleges
            $post_query = $db->prepare('SELECT (SUM(CASE WHEN lp.is_like = true THEN 1 ELSE 0 END)::float / 
                                  (CASE (SUM(CASE WHEN lp.is_like = true THEN 1 ELSE 0 END) + SUM(CASE WHEN lp.is_like = false THEN 1 ELSE 0 END)) 
                                    WHEN 0 
                                    THEN 1 
                                    ELSE (SUM(CASE WHEN lp.is_like = true THEN 1 ELSE 0 END) + SUM(CASE WHEN lp.is_like = false THEN 1 ELSE 0 END)) 
                                    END)::float) AS rating,
                                  p.post_id, p.content, p.college_id, to_char(p.sent_date, \'Month DD, YYYY at HH12:MI PM\') AS sent_date_f, p.sent_date, college.name
                                  FROM post p JOIN
                                  college ON p.college_id = college.college_id
                                  LEFT OUTER JOIN like_post lp
                                  ON p.post_id = lp.post_id                                  
                                  WHERE p.post_id = :post_id
								  GROUP BY p.post_id, p.content, p.college_id, sent_date, college.name;');

            $post_query->execute(array(':post_id' => $_GET["post_id"]));
            $row = $post_query->fetch(PDO::FETCH_ASSOC);

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
                $num_comments_query->execute(array((':post_id') => $row['post_id']));
                $num_comments_result = $num_comments_query->fetchColumn();
                $rating = round($row["rating"] * 100);
                echo '<div class="panel panel-default">
                      <div class="panel-body"><span class="pull-left">Published on ' . $row['sent_date_f'] . '</span><span class="pull-right">' . $row['name']. '</span><br><br>' . $row['content'] .
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

                echo '<div class="well well-sm success-color bottom-buffer-20">Comments</div>';

            $comments_query = $db->prepare('SELECT "user".first_name, "user".last_name, "user".college_id, c.content, c.sent_date, "user".profile_pic_url,
                                                      co.name, c.comment_id,
                                                      to_char(c.sent_date, \'Month DD, YYYY at HH12:MI PM\') AS sent_date_f
                                                      FROM "user"  JOIN comment c
                                                      ON "user".user_id = c.user_id
                                                      JOIN college co
                                                      ON co.college_id = "user".college_id
                                                      WHERE post_id = :post_id
                                                      LIMIT 5 OFFSET (5 * (:offset - 1))');

            $comments_query->execute(array(':post_id' => $_GET["post_id"], ':offset' => $_GET['page']));



            while ($row2 = $comments_query->fetch(PDO::FETCH_ASSOC))
            {
                $rating_comment_query = $db->prepare('SELECT 
                                                                SUM
                                                                (CASE 
                                                                    WHEN is_like = true THEN 1
                                                                    ELSE -1
                                                                END) as "ratingc",
                                                                comment_id
                                                                FROM like_comment
                                                                WHERE comment_id = :comment_id
                                                                GROUP BY comment_id');

                $rating_comment_query->execute(array(':comment_id' => $row2['comment_id']));
                $ratingc = $rating_comment_query->fetch(PDO::FETCH_ASSOC);

                $results_av_query = '';
                $already_voted_query = '';

                if (isset($_SESSION["username"]))
                {
                    $already_voted_query = $db->prepare('SELECT EXISTS(SELECT  1 FROM like_comment 
                                                                  WHERE comment_id = :comment_id
                                                                  AND user_id = :user_id) AS "exists"');

                    $already_voted_query->execute(array(':comment_id' => $row2['comment_id'], ':user_id' => $_SESSION['user_id']));

                    $results_av_query = $already_voted_query->fetch(PDO::FETCH_ASSOC);
                }

                echo '<div class="panel panel-default top-buffer-10">
                    <div class="panel-body">
                    <span class="pull-left">';

                if (isset($_SESSION["username"]))
            {
                if ($results_av_query["exists"] == false)
                {
                    echo '<div class="btn-group btn-group-xs">
                      <a href="liking_comment.php?like=1&comment_id=' . $row2['comment_id'] .'" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-thumbs-up"></span></a>
                      <a href="liking_comment.php?like=0&comment_id=' . $row2['comment_id'] .'" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-thumbs-down"></span></a>
                    </div>';

                }
                else
                {
                    echo '<div class="btn-group btn-group-xs">
                      <a href="#" data-toggle="tooltip" title="You already voted" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-thumbs-up"></span></a>
                      <a href="#" data-toggle="tooltip" title="You already voted" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-thumbs-down"></span></a>
                    </div>';
                }

            }
            else
            {
                echo '<div class="btn-group btn-group-xs">
                      <a href="#" data-toggle="tooltip" title="You must be logged in" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-thumbs-up"></span></a>
                      <a href="#" data-toggle="tooltip" title="You must be logged in" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-thumbs-down"></span></a>
                    </div>';
            }

            echo '</span>
                    <span class="pull-left"';

                if ($ratingc["ratingc"] >= 0)
                {
                    if ($ratingc["ratingc"] > 0)
                    {
                        echo 'style="color: green;">&nbsp;&nbsp;+' . $ratingc["ratingc"];
                    }
                    else
                    {
                        echo 'style="color: gray;">&nbsp;&nbsp;' . $ratingc["ratingc"];
                    }
                }
                else
                {
                    echo 'style="color: red;">&nbsp;&nbsp;' . $ratingc["ratingc"];
                }

            echo '</span>
                    <span class="pull-right">' . $row2['name'] . '</span><br>
                    <div class="media">
                      <div class="media-left">
                        <img src="' . $row2['profile_pic_url'] .'" class="media-object" style="width:60px; height: 60px; border-radius: 6%;">
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading">' . $row2['first_name']. ' ' . $row2['last_name'] . '</h4>
                        <p>' . $row2['content'] . '</p>
                      </div>                    
                    </div>       
                                <span class="pull-right">' . $row2['sent_date_f'] . '</span>
                    </div>
                </div>';
            }
            ?>
            <?php if (isset($_SESSION["username"])) : ?>
                <form method="post" action="comment_loading.php">
                    <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Comment</button>
                    <input type="hidden" name="post_id" value="<?php echo $_GET["post_id"] ?>">
                </form>
            <?php else : ?>
                <div class="panel panel-default">
                    <div class="panel-body">You need to be registered to be able to comment.<br><br>
                        <a href="signup.php">Sign up</a> or <a href="#" onclick="popOverOnClick();">log in</a>.
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php include "universities.php" ?>
        <div class="col-xs-2"></div>
    </div>
    <div class="row">
        <div class="col-xs-2"></div>
        <div class="col-xs-5 text-center">
            <ul class="pagination center-list">
                <?php
                $pages_query = $db->prepare('SELECT comment_id FROM comment WHERE post_id = :post_id');
                $pages_query->execute(array(':post_id' => $_GET["post_id"]));

                //5 posts per page
                $count_pages = $pages_query->rowCount() / 5;

                if (($pages_query->rowCount() % 5) != 0)
                {
                    $count_pages++;
                }

                for ($x = 1; $x <= $count_pages; $x++) {
                    echo "<li><a href=\"comment.php?page=" . $x . "&post_id=" . $_GET["post_id"] ."\">" .  $x ."</a></li>";
                }
                ?>
            </ul>
        </div>
        <div class="col-xs-3"></div>
        <div class="col-xs-2"></div>
    </div>
<?php include "footer.php" ?>
