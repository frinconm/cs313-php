<?php

echo '<div class="col-xs-3">
            <div class="panel panel-default">
                <div class="panel-heading">University</div>
                <div class="panel-body">
                    <div class="list-group">
                        <a href="' . addOrUpdateUrlParam("college_id", 0) . '" class="list-group-item">All</a>
                        <a href="' . addOrUpdateUrlParam("college_id", 1) . '" class="list-group-item">Brigham Young University</a>
                        <a href="' . addOrUpdateUrlParam("college_id", 2) . '" class="list-group-item">Brigham Young University - Idaho</a>
                        <a href="' . addOrUpdateUrlParam("college_id", 3) . '" class="list-group-item">Brigham Young University - Hawaii</a>
                        <a href="' . addOrUpdateUrlParam("college_id", 4) . '" class="list-group-item">Ohio State University</a>
                    </div>
                </div>
            </div>
        </div>';