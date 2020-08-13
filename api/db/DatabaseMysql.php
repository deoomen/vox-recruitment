<?php

namespace VOX\Api\Db;

class DatabaseMysql
{
    private string $host;
    private int $port;
    private string $username;
    private string $password;
    private string $dbname;
    private ?\PDO $connection;

    public function __construct(string $host, int $port, string $username, string $password, string $dbname)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->connection = null;
    }

    public function connect()
    {
        if ($this->connection === null) {
            try {
                $this->connection = new \PDO(
                    "mysql:host={$this->host};port={$this->port};dbname={$this->dbname}",
                    $this->username,
                    $this->password,
                    [
                        \PDO::ATTR_DEFAULT_FECTH_MODE => \PDO::FETCH_OBJ,
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                    ]
                );
            } catch (\Exception $ex) {
                \error_log("", 3, __DIR__ . "/../logs/db_errors_" . \date("Ymd") . ".log");
                return false;
            }
        }

        return true;
    }
}
