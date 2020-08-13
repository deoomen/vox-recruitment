<?php

namespace VOXApi\Endpoints;

use VOXApi\Db\DatabaseMysql;

abstract class Api
{
    protected DatabaseMysql $database;

    public function __construct()
    {
        $this->database = new DatabaseMysql();
    }

    public abstract function getItems(): array;

    public abstract function getItemsAsArray(): array;
}
