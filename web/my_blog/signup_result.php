<?php

include "function.php";
include "connect.php";
include "header.php";
?>

    <div class="row">
        <div class="col-xs-2"></div>
        <div class="col-xs-5 center-block">
            <div class="alert alert-success">
                <strong>Success!</strong> Your account has been registered.
            </div>
            <a href="index.php" class="btn btn-primary">Go back to home page</a>
        </div>
        <?php include 'universities.php'; ?>
        <div class="col-xs-2"></div>
    </div>

<?php include "footer.php" ?>