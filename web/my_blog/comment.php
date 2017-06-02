<?php

include "function.php";
include "connect.php";
include "header.php"; ?>

    <div class="row">
        <div class="col-xs-2"></div>
        <div class="col-xs-5">
            <?php
            //All colleges
            $post_query = $db->prepare('SELECT (p.likes::float / (CASE (p.likes + p.dislikes) WHEN 0 THEN 1 ELSE (p.likes + p.dislikes) END)::float) AS rating,
                                  post_id, content, p.college_id, likes, dislikes, sent_date, college.name
                                  FROM post p JOIN
                                  college ON p.college_id = college.college_id
                                  WHERE p.post_id = :post_id');

            $post_query->execute(array(':post_id' => $_GET["post_id"]));
            $row = $post_query->fetch(PDO::FETCH_ASSOC);

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
                          <p class="pull-right">' . $num_comments_result . ' Comments 
                          <span class="glyphicon glyphicon-comment"></span></p>
                      </div>
                      </div>';

                echo '<div class="well well-sm success-color bottom-buffer-20">Comments</div>';

            $comments_query = $db->prepare('SELECT "user".first_name, "user".last_name, "user".college_id, c.content, c.likes, c.dislikes, c.sent_date
                                                      FROM "user"  JOIN comment c
                                                      ON "user".user_id = c.user_id
                                                      JOIN college co
                                                      ON co.college_id = "user".college_id
                                                      WHERE post_id = :post_id');

            $comments_query->execute(array(':post_id' => $_GET["post_id"]));

            while ($row2 = $comments_query->fetch(PDO::FETCH_ASSOC))
            {
                echo '<div class="panel panel-default top-buffer-10">
                    <div class="panel-body">
                    <span class="pull-right">' . $row2['first_name']. ' ' . $row2['last_name'] . '</span><br>' .
                    $row2['content'] . '
                    </div>
                </div>';
            }
            ?>
        </div>
        <?php include "universities.php" ?>
        <div class="col-xs-2"></div>
    </div>
    <div class="row">
        <div class="col-xs-2"></div>
        <div class="col-xs-5">
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
        <div class="col-xs-5"></div>
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
