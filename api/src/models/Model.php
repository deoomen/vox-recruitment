<?php

namespace VOXApi\Models;

/**
 * Abstract base model
 *
 * @category Model
 * @author deoomen <deoomen@pm.me>
 */
abstract class Model
{
    protected int $id;

    /**
     * Return object id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Return object as array
     *
     * @return array
     */
    abstract public function toArray(): array;
}
