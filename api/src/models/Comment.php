<?php

namespace VOXApi\Models;

class Comment
{
    private ?int $id;
    private string $author;
    private string $text;
    private \DateTimeImmutable $createdAt;

    public function __construct(string $author, string $text, ?int $id = null, ?\DateTimeImmutable $createdAt = null)
    {
        $this->id = $id;
        $this->author = $author;
        $this->text = $text;
        $this->createdAt = $createdAt ?? (new \DateTimeImmutable());
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
