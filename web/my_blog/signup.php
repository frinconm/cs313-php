<?php

include "function.php";
include "connect.php";
include "header.php"; ?>

<div class="row">
    <div class="col-xs-2"></div>
    <div class="col-xs-5 center-block">
        <form method="post" action="signup_loading.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" name="pwd">
            </div>
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="first_name">First name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name">
            </div>
            <div class="form-group">
                <label for="last_name">Last name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name">
            </div>
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
                <label for="prof_pic">Profile picture(URL):</label>
                <input type="text" class="form-control" id="prof_pic" name="prof_pic">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
    <?php include 'universities.php'; ?>
    <div class="col-xs-2"></div>
</div>

<?php include "footer.php"?>
