<?php

echo '<div class="col-xs-3">
            <div class="panel panel-primary">
                <div class="panel-heading">University</div>
                <div class="panel-body">
                    <div class="list-group">
                        <a href="' . addOrUpdateUrlParam("college_id", 0) . '" class="list-group-item ';

if ($_GET["college_id"] == 0) { echo "active"; }

echo '">All</a>
                        <a href="' . addOrUpdateUrlParam("college_id", 1) . '" class="list-group-item ';

if ($_GET["college_id"] == 1) { echo "active"; }

echo '">Brigham Young University</a>
                        <a href="' . addOrUpdateUrlParam("college_id", 2) . '" class="list-group-item ';

if ($_GET["college_id"] == 2) { echo "active"; }

echo '">Brigham Young University - Idaho</a>
                        <a href="' . addOrUpdateUrlParam("college_id", 3) . '" class="list-group-item ';

if ($_GET["college_id"] == 3) { echo "active"; }

echo '">Brigham Young University - Hawaii</a>
                        <a href="' . addOrUpdateUrlParam("college_id", 4) . '" class="list-group-item ';

if ($_GET["college_id"] == 4) { echo "active"; }

echo '">Ohio State University</a>
                    </div>
                </div>
            </div>
        </div>';