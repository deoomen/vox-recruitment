<?php

namespace VOXApi\Models;

/**
 * Undocumented class
 *
 * @category Api
 * @author deoomen <deoomen@pm.me>
 */
class Comment
{
    private int $id;
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
     * Return comment id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set comment id
     *
     * @param int $value comment id
     *
     * @return self
     */
    public function setId(int $value): self
    {
        $this->id = $value;

        return $this;
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
     * Return comment creation time
     *
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
