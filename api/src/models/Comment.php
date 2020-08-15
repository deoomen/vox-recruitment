<?php

namespace VOXApi\Models;

use VOXApi\Db\DatabaseMysql;
use VOXApi\Helpers\Logger;

/**
 * Undocumented class
 *
 * @category Api
 * @author deoomen <deoomen@pm.me>
 */
class Comment extends Model
{
    private string $author;
    private string $text;
    private \DateTimeImmutable $createdAt;

    /**
     * Init `Comment` object
     *
     * @param \stdClass $object comment raw object data
     */
    public function __construct(\stdClass $object)
    {
        $this->id = $object->id ?? 0;
        $this->author = $object->author;
        $this->text = $object->text;
        $this->createdAt = new \DateTimeImmutable($object->created_at ?? "now");
    }

    /**
     * Return comment author name
     *
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * Set comment author name
     *
     * @param string $value author name
     *
     * @return self
     */
    public function setAuthor(string $value): self
    {
        $this->author = $value;

        return $this;
    }

    /**
     * Return comment text
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Set comment text
     *
     * @param string $value comment text
     *
     * @return self
     */
    public function setText(string $value): self
    {
        $this->text = $value;

        return $this;
    }

    /**
     * Return comment creation time in given format,
     * if no format specified - returns `\DateTimeImmutable` object
     *
     * @param string $format `\DateTimeImmutable` format
     *
     * @return \DateTimeImmutable|string
     */
    public function getCreatedAt(string $format = "")
    {
        return $format ? $this->createdAt->format($format) : $this->createdAt;
    }

    /**
     * Return comment as array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "author" => $this->author,
            "text" => $this->text,
            "createdAt" => $this->getCreatedAt("Y-m-d H:i")
        ];
    }

    /**
     * Save comment object to database
     *
     * @return int values <0 means error
     */
    public function save(): int
    {
        $connection = DatabaseMysql::connection();
        try {
            if ($this->id === 0) {  // add new
                $query = "INSERT INTO `comment` VALUES (null, :author, :text, :createdAt)";
                $stmt = $connection->prepare($query);
                $stmt->bindParam(":author", $this->author);
                $stmt->bindParam(":text", $this->text);
                $createdAt = $this->getCreatedAt("Y-m-d H:i:s");
                $stmt->bindParam(":createdAt", $createdAt);
                if ($stmt->execute()) {
                    $this->id = $connection->lastInsertId();
                }
            } elseif ($this->id > 0) {  // update
            }
        } catch (\Exception $ex) {
            Logger::log(\implode(" - ", [
                "Code: {$ex->getCode()}",
                "Line: {$ex->getLine()}",
                "Message: {$ex->getMessage()}"
            ]), Logger::FILENAME_DATABASE);
            return -1;
        }

        return $this->id;
    }
}
