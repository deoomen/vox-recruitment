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

    public function getItems(): array
    {
        $query = "SELECT `c`.`id`, `c`.`author`, `c`.`text`, `c`.`created_at`
            FROM `{$this->tableName}` AS `c`
            ORDER BY `c`.`created_at` DESC
            LIMIT {$this->page}, {$this->perPage}
        ";

        $stmt = $this->database->connection()->prepare($query);
        $stmt->bindParam(":page", $this->page);
        $stmt->bindParam(":perPage", $this->perPage);

        $items = [];
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()) {
                // \var_dump($row);exit;
                $items[] = new Comment($row);
            }
        }


        return $items;
    }
}
