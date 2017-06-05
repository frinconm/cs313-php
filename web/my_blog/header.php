<?php
session_start();

echo '<!DOCTYPE html>
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
        
        <!--My script -->
        <script src="js/script.js"></script>
        
        <!--My style -->
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
                        <a class="navbar-brand" href="index.php">Secrets</a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="' . addOrUpdateUrlParam("nonlatest", 0) . '">Latest</a></li>
                        <li ><a href="' . addOrUpdateUrlParam("nonlatest", 1) . '">Top Rated</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li>';

if (isset($_SESSION["username"]))
{
    echo '
    <div id="loggedin" class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
    <img src="' . $_SESSION["profile_pic_url"] .'" style="width:50px; height: 40px; border-radius: 6%;">&nbsp&nbsp&nbspWelcome, '. $_SESSION["username"] .'&nbsp&nbsp&nbsp
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
    <li><a href="#">Profile</a></li>
    <li><a href="logout_loading.php">Logout</a></li>
    </ul>
    </div>';
}
else
{
    echo '<a data-html="true" href="#" id="login" data-toggle="popover" data-placement="bottom" data-content="
                        <form method=\'post\' action=\'login_loading.php\'>
                        <div class=\'form-group\'>
                            <label for=\'username\'>Username:</label>
                            <input type=\'text\' class=\'form-control\' id=\'username\' name=\'username\'>
                        </div>
                        <div class=\'form-group\'>
                            <label for=\'pwd\'>Password:</label>
                            <input type=\'password\' class=\'form-control\' id=\'pwd\' name=\'pwd\'>
                        </div>
                        <button type=\'submit\' class=\'btn btn-primary\'>Login</button>
                        </form>"><span class="glyphicon glyphicon-log-in"></span> Login</a>';
}
                        echo '</li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="col-xs-2"></div>
    </div>
    <div class="row bottom-buffer-20">
        <div class="col-xs-2"></div>
        <div class="col-xs-7">';

    if ($_SESSION["wrong"] == true)
    {
        echo '<div class="alert alert-danger">
    Wrong username or password.
        </div>';

        $_SESSION["wrong"] = false;

        echo '<script type="text/javascript">',
        'popOverOnClick();',
        '</script>'
        ;
    }

    echo '
        </div>
        <div class="col-xs-1">
            <div class="pull-right">
                <a href="new_post.php" class="btn btn-warning">New Secret</a>
            </div>
        </div>
        <div class="col-xs-2"></div>
    </div>';