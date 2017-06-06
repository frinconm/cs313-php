<?php

function addOrUpdateUrlParam($name, $value)
{
    $params = $_GET;
    unset($params[$name]);
    unset($params["page"]);
    $params["page"] = 1;
    $params[$name] = $value;
    return 'index.php?'.http_build_query($params);
}
//https://stackoverflow.com/questions/3162725/how-can-i-add-get-variables-to-end-of-the-current-url-in-php
