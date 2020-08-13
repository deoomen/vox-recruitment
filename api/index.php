<?php

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

switch ($_GET["endpoint"]) {
    case "comments":
        include_once "endpoints/comments.php";
        break;
}
