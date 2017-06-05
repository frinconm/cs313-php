<?php

include "function.php";
include "connect.php";
include "header.php";

$_SESSION["current"] = 'new_post.php';
?>
    <div class="row">
        <div class="col-xs-2"></div>
        <div class="col-xs-5">
            <form method="post" action="post_loading.php">
                <div class="form-group">
                    <label for="university">Select university:</label>
                    <select class="form-control" id="university" name="university">
                        <option value="1">Brigham Young University</option>
                        <option value="2">Brigham Young University - Idaho</option>
                        <option value="3">Brigham Young University - Hawaii</option>
                        <option value="4">Ohio State University</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="secret">Secret:</label>
                    <textarea class="form-control" rows="5" id="secret" name="secret_content"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <?php include 'universities.php'; ?>
        <div class="col-xs-2"></div>
    </div>
<?php include "footer.php" ?>
