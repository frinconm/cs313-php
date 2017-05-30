<?php
session_start();

// default Heroku Postgres configuration URL
$dbUrl = getenv('DATABASE_URL');

if (empty($dbUrl)) {
    // example localhost configuration URL with postgres username and a database called cs313db
    $dbUrl = "postgres://postgres:5720297@localhost:5432/postgres";
}

$dbopts = parse_url($dbUrl);


$dbHost = $dbopts["host"];
$dbPort = $dbopts["port"];
$dbUser = $dbopts["user"];
$dbPassword = $dbopts["pass"];
$dbName = ltrim($dbopts["path"],'/');


try {
    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
}
catch (PDOException $ex) {
    print "<p>error: $ex->getMessage() </p>\n\n";
    die();
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Secrets</title>
    <!--JQuery -->
    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <!--Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/extra-style.css">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-2"></div>
        <div class="col-xs-8">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Secrets</a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="col-xs-2"></div>
    </div>
    <div class="row bottom-buffer-20">
        <div class="col-xs-2"></div>
        <div class="col-xs-5"></div>
        <div class="col-xs-3">
            <div class="btn-group pull-right">
                <a href="" class="btn btn-primary">Latest</a>
                <a href="" class="btn btn-primary">Best</a>
                <a href="" class="btn btn-warning">New Secret</a>
            </div>
        </div>
        <div class="col-xs-2"></div>
    </div>
    <div class="row">
        <div class="col-xs-2"></div>
        <div class="col-xs-5">
            <?php
            foreach ($db->query('SELECT post_id, content, p.college_id, likes, dislikes, sent_date, college.name
                                  FROM post p JOIN
                                  college ON p.college_id = college.college_id') as $row)
            {
                $num_comments_query = $db->prepare('SELECT coalesce(count(comment_id), 0) as num_comments FROM comment WHERE post_id = :post_id');
                $num_comments_query->execute(array((':post_id') => $row['post_id']));
                $num_comments_result = $num_comments_query->fetchColumn();
                $rating = round(($row['likes'] / ($row['likes'] + $row['dislikes'])) * 100);
                echo '<div class="panel panel-default top-buffer-10">
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
            }
            ?>
        </div>
        <div class="col-xs-3">
            <div class="panel panel-default">
                <div class="panel-heading">College</div>
                <div class="panel-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item">Brigham Young University</a>
                        <a href="#" class="list-group-item">Brigham Young University - Idaho</a>
                        <a href="#" class="list-group-item">Brigham Young University - Hawaii</a>
                        <a href="#" class="list-group-item">Ohio State University</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-2"></div>
    </div>
    <div class="row">
        <div class="col-xs-2"></div>
        <div class="col-xs-5 align="center">
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
</div>
</body>
</html>
