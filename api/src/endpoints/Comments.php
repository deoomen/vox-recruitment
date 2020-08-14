<?php

namespace VOXApi\Endpoints;

use VOXApi\Endpoints\Api;
use VOXApi\Models\Comment;

/**
 * Undocumented class
 *
 * @category Api
 * @author deoomen <deoomen@pm.me>
 */
class Comments extends Api
{
    /**
     * Init, set table name and default per page
     */
    public function __construct()
    {
        parent::__construct();

        $this->tableName = "comment";
        $this->setPerPage(10);
    }

    /**
     * Return array of objects representing comments from database
     *
     * @return \VOXApi\Models\Comment[]
     */
    public function getItems(): array
    {
        $stmt = $this->database->prepare(
            "SELECT `c`.`id`, `c`.`author`, `c`.`text`, `c`.`created_at`
            FROM `{$this->tableName}` AS `c`
            ORDER BY `c`.`created_at` DESC, `c`.`id` DESC
            LIMIT {$this->getOffset()}, {$this->getPerPage()}"
        );

        $items = [];
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()) {
                $items[] = new Comment($row);
            }
        }

        return $items;
    }

    /**
     * Return array of objects as array representing comments from database
     *
     * @return array
     */
    public function getItemsAsArray(): array
    {
        $commentsAsArray = [];
        foreach ($this->getItems() as $comment) {
            $commentsAsArray[] = [
                "id" => $comment->getId(),
                "author" => $comment->getAuthor(),
                "text" => $comment->getText(),
                "createdAt" => $comment->getCreatedAt()->format("Y-m-d H:i")
            ];
        }

        return $commentsAsArray;
    }

    public function validateNewComment(array $postData): array
    {
        $return = [
            "status" => true,
            "messages" => []
        ];

        $postData["nick"] = $this->sanitizeVar($postData["nick"]);
        $postData["text"] = $this->sanitizeVar($postData["text"]);

        $nickLength = \strlen($postData["nick"]);
        $textLength = \strlen($postData["text"]);

        if (\strlen($postData["hp"]) > 0) {
            $return["status"] = false;
        }

        if ($nickLength === 0 || $nickLength > 30) {
            $return["status"] = false;
            $return["messages"][] = [
                "field" => "nick",
                "message" => "Długość nicku musi być między 1 a 30 znaków"
            ];
        }

        if ($textLength === 0 || $textLength > 500) {
            $return["status"] = false;
            $return["messages"][] = [
                "field" => "text",
                "message" => "Długość tekstu musi być między 1 a 500 znaków"
            ];
        }

        if ($return["status"] === true) {
            $comment = new Comment((object) [
                "author" => $postData["nick"],
                "text" => $postData["text"]
            ]);
            \var_dump($comment);exit;
        }

        return $return;
    }
}
