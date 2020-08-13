<?php

namespace VOXApi\Endpoints;

use VOXApi\Endpoints\Api;
use VOXApi\Models\Comment;

class Comments extends Api
{
    private string $tableName = "comment";
    private int $page;
    private int $perPage;

    public function __construct()
    {
        parent::__construct();

        $this->page = 0;
        $this->perPage = 10;
    }

    /**
     * Undocumented function
     *
     * @return \VOXApi\Models\Comment[]
     */
    public function getItems(): array
    {
        $query = "SELECT `c`.`id`, `c`.`author`, `c`.`text`, `c`.`created_at`
            FROM `{$this->tableName}` AS `c`
            ORDER BY `c`.`created_at` DESC, `c`.`id` DESC
            LIMIT {$this->page}, {$this->perPage}
        ";

        $stmt = $this->database->connection()->prepare($query);
        $stmt->bindParam(":page", $this->page);
        $stmt->bindParam(":perPage", $this->perPage);

        $items = [];
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()) {
                $items[] = new Comment($row);
            }
        }

        return $items;
    }

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
}
