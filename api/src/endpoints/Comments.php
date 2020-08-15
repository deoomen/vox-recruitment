<?php

namespace VOXApi\Endpoints;

use VOXApi\Endpoints\Api;
use VOXApi\Helpers\Logger;
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
            $commentsAsArray[] = $comment->toArray();
        }

        return $commentsAsArray;
    }

    /**
     * Validate comment form fields
     *
     * @param array $postData form fields
     *
     * @return array
     */
    public function validateNewComment(array $postData): array
    {
        $return = [
            "status" => true,
            "messages" => []
        ];

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

        // if ($return["status"] === true) {
            // $return = new Comment((object) [
            //     "author" => $postData["nick"],
            //     "text" => $postData["text"]
            // ]);
        // }

        return $return;
    }

    /**
     * Returns voucher code
     *
     * @return string
     */
    public function getVoucher(): string
    {
        $return = "";

        try {
            $curl = \curl_init();
            \curl_setopt_array($curl, [
                \CURLOPT_URL => "http://www.meble.vox.pl/rekrutacja/voucher-098cdcff8f1341f213ed69c2228862a0",
                \CURLOPT_HTTPHEADER => [
                    "X-ApiKey: 098cdcff8f1341f213ed69c2228862a0"
                ],
                \CURLOPT_RETURNTRANSFER => true
            ]);
            $response = \curl_exec($curl);
            $httpcode = \curl_getinfo($curl, \CURLINFO_HTTP_CODE);
            \curl_close($curl);

            if ($httpcode === 200) {
                $json = \json_decode($response);
                $return = $json->voucher;
            }
        } catch (\Exception $ex) {
            Logger::log(\implode(" - ", [
                "Code: {$ex->getCode()}",
                "Line: {$ex->getLine()}",
                "Message: {$ex->getMessage()}"
            ]), Logger::FILENAME_ERRORS);
        }

        return $return;
    }
}
