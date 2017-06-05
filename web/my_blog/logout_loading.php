<?php

session_start();
include "connect.php";

unset($_SESSION["first_name"], $_SESSION["last_name"], $_SESSION["username"], $_SESSION["profile_pic_url"]);

header('Location: '.$_SESSION["current"]);