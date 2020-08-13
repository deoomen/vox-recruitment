<?php

namespace VOXApi\Endpoints;

use VOXApi\Db\DatabaseMysql;

abstract class Api
{
    private int $page;
    private int $perPage;
    private int $offset;
    protected DatabaseMysql $database;
    protected string $tableName;

    public function __construct()
    {
        $this->database = new DatabaseMysql();
        $this->page = 0;
        $this->perPage = 1;
        $this->calcOffset();
    }

    public final function getPage(): int
    {
        return $this->page;
    }

    public final function setPage(int $page): void
    {
        $this->page = $page;
        $this->calcOffset();
    }

    public final function getPerPage()
    {
        return $this->perPage;
    }

    public final function setPerPage(int $perPage): void
    {
        $this->perPage = $perPage;
        $this->calcOffset();
    }

    private final function calcOffset(): void
    {
        $this->offset = $this->page * $this->perPage;
    }

    public final function getOffset(): int
    {
        return $this->offset;
    }

    public abstract function getItems(): array;

    public abstract function getItemsAsArray(): array;
}
