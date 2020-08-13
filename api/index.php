<?php

require "vendor/autoload.php";

use VOXApi\Endpoints\Comments;

\var_dump($_SERVER, $_GET);

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        break;

    case "POST":
        break;

    default:
        header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed", true, 405);
        exit;
}

$api = null;
switch ($_GET["endpoint"]) {
    case "comments":
        $api = new Comments();
        break;

    default:
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
        exit;
}

$items = $api->getItems();
\var_dump($items);
