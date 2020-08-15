<?php

namespace VOXApi\Endpoints;

use VOXApi\Db\DatabaseMysql;

/**
 * Undocumented class
 *
 * @category Api
 * @author deoomen <deoomen@pm.me>
 */
abstract class Api
{
    private int $page;
    private int $perPage;
    private int $offset;
    protected \PDO $database;
    protected string $tableName;

    /**
     * Init properties
     */
    public function __construct()
    {
        $this->database = DatabaseMysql::connection();
        $this->page = 0;
        $this->perPage = 1;
        $this->calcOffset();
    }

    /**
     * Return current page
     *
     * @return int
     */
    final public function getPage(): int
    {
        return $this->page;
    }

    /**
     * Set current page
     *
     * @param int $page current page
     *
     * @return void
     */
    final public function setPage(int $page): void
    {
        $this->page = $page;
        $this->calcOffset();
    }

    /**
     * Return how much rows per page
     *
     * @return void
     */
    final public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * Set how much rows per page
     *
     * @param int $perPage rows per page
     *
     * @return void
     */
    final public function setPerPage(int $perPage): void
    {
        $this->perPage = $perPage;
        $this->calcOffset();
    }

    /**
     * Calculate current rows offset
     *
     * @return void
     */
    final private function calcOffset(): void
    {
        $this->offset = $this->page * $this->perPage;
    }

    /**
     * Return current rows offset
     *
     * @return int
     */
    final public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * Should return array of objects from database
     *
     * @return array
     */
    abstract public function getItems(): array;

    /**
     * Should return array of objects as array from database
     *
     * @return array
     */
    abstract public function getItemsAsArray(): array;

    /**
     * Sanitie string variable
     *
     * @param string $var variable to sanitize
     *
     * @return string
     */
    public function sanitizeVar(string $var): string
    {
        return \trim(
            \strip_tags(
                $var
            )
        );
    }
}
