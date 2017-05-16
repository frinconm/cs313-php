<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form handling</title>
</head>
<body>
<p>Username: <?php echo $_POST["name"] ?></p>
<p>Email: <?php echo "<a href=\"mailto:".$_POST["email"]."?Subject=Hello%20again target=\"_top\">".$_POST["email"]."</a>" ?></p>
<p>Major: <?php echo $_POST["major"] ?></p>
<p>Comment: <?php echo $_POST["comment"] ?></p>
<p>I have visited:
    <?php foreach($_POST['checkList'] as $selected){
            echo $selected.", ";
    } ?></p>
</body>
</html>