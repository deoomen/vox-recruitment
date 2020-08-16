<?php

if (!\in_array($_SERVER["REQUEST_METHOD"], ["GET", "POST"])) {
    \header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed", true, 405);
    exit;
}

require "vendor/autoload.php";

use PleaseDontSwear\PleaseDontSwear;
use VOXApi\Endpoints\Comments;
use VOXApi\Endpoints\Slides;
use VOXApi\Models\Comment;

$endpoint = \filter_input(\INPUT_GET, "endpoint", \FILTER_SANITIZE_STRING);
switch ($_SERVER["REQUEST_METHOD"] . $endpoint) {
    case "GETcomments":
        $comments = new Comments();
        $page = \filter_input(
            \INPUT_GET,
            "page",
            \FILTER_VALIDATE_INT,
            [
                "options" => [
                    "default" => 0,
                    "min_range" => 0
                ]
            ]
        );

        $comments->setPage($page);
        $return = $comments->getItemsAsArray();
        break;

    case "POSTcomments":
        $comments = new Comments();
        $nick = $comments->sanitizeVar(\filter_input(\INPUT_POST, "nick", \FILTER_SANITIZE_STRING));
        $text = $comments->sanitizeVar(\filter_input(\INPUT_POST, "text", \FILTER_SANITIZE_STRING));
        $return = $comments->validateNewComment([
            "hp" => \filter_input(\INPUT_POST, "hp", \FILTER_SANITIZE_STRING),
            "nick" => $nick,
            "text" => $text
        ]);

        if ($return["status"] === true) {
            $pds = new PleaseDontSwear();
            $comment = new Comment((object) [
                "author" => $pds->censor($nick),
                "text" => $pds->censor($text)
            ]);
            if ($comment->save() > 0) {
                $return["voucher"] = $comments->getVoucher();
                $return["comment"] = $comment->toArray();

                \header($_SERVER["SERVER_PROTOCOL"] . " 201 Created", true, 201);
            }
        }
        break;

    case "GETslides":
        $slides = new Slides();
        $return = $slides->getItemsAsArray();
        break;

    default:
        \header($_SERVER["SERVER_PROTOCOL"] . " 400 Bad Request", true, 400);
        exit;
}

if (empty($return)) {
    \header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
    exit;
}

header("Content-Type: application/json;charset=utf-8");
echo \json_encode($return);
exit;
