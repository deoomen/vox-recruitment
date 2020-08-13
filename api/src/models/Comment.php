<?php

namespace VOXApi\Models;

class Comment
{
    private ?int $id;
    private string $author;
    private string $text;
    private \DateTimeImmutable $createdAt;

    // public function __construct(string $author, string $text, ?int $id = null, ?\DateTimeImmutable $createdAt = null)
    public function __construct(\stdClass $object)
    {
        $this->id = $object->id;
        $this->author = $object->author;
        $this->text = $object->text;
        $this->createdAt = new \DateTimeImmutable($object->created_at ?? "now");
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $value): self
    {
        $this->id = $value;

        return $this;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $value): self
    {
        $this->author = $value;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $value): self
    {
        $this->text = $value;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
