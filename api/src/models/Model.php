<?php

namespace VOXApi\Models;

abstract class Model
{
    protected int $id;

    /**
     * Return comment id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    abstract public function toArray(): array;
}
