<?php

require "vendor/autoload.php";

use VOXApi\Endpoints\Comments;

// \var_dump($_SERVER, $_GET);

if (!\in_array($_SERVER["REQUEST_METHOD"], ["GET", "POST"])) {
    \header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed", true, 405);
    exit;
}

$api = null;
switch ($_SERVER["REQUEST_METHOD"] . $_GET["endpoint"]) {
    case "GETcomments":
        $api = new Comments();
        $items = $api->getItems();
        \var_dump($items);
        $return = $items;
        break;

    default:
        \header($_SERVER["SERVER_PROTOCOL"] . " 400 Bad Request", true, 400);
        exit;
}

if (empty($return)) {
    \header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
    exit;
}

// header("Content-Type: application/json;charset=utf-8");
echo \json_encode($return);
exit;
